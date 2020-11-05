import spacy
import random
import entity_recognition_data

def displayentityformat(model, input_user):

    document = model(input_user)
    entities = ''
    i = 0

    for ent in document.ents:
        if len(document.ents) - 1 == i:
            entities += '({}, {}, \"{}\")'.format(ent.start_char, ent.end_char, ent.label_)
        else:
            entities += '({}, {}, \"{}\"), '.format(ent.start_char, ent.end_char, ent.label_)
            i += 1
        print('("{}", {{"entities": [{}]}}),'.format(input_user, entities))

def recognize_entities(input_user):

    trainable = False

    # Data that will be used to train the entity recognition.
    traindata = entity_recognition_data.preprocessdata()

    if trainable:
        # train the model & save the model
        model = train_spacy(traindata, 30)
        model.to_disk('entity_recognition_model')

        displayentityformat(model, input_user)
    else:
        # Load the model from disk en add to variable.
        model_from_disk = spacy.load('entity_recognition_model')
        model = model_from_disk

        displayentityformat(model, input_user)

    ner_object = model(input_user)
    entities = []

    # add all entities to a list.
    for entity in ner_object.ents:
        entities.append(entity.text)

        # show the entity + position int the sentence.
        #print(entity.text, entity.start_char, entity.end_char, entity.label_)


# create ner model. train data.
def train_spacy(data, timeshowntochatbot):
    traindata = data

    # create an empty model with english preset.
    nlp = spacy.blank('en')

    # after creating a new model we must add the entity recognizer as a 'pipe' to the pipeline.
    if 'ner' not in nlp.pipe_names:
        ner = nlp.create_pipe('ner')
        nlp.add_pipe(ner, last=True)

    # add labels
    for _, annotations in traindata:
        for ent in annotations.get('entities'):
            ner.add_label(ent[2])

    # get all pipes except 'ner'
    pipes = [pipe for pipe in nlp.pipe_names if pipe != 'ner']

    # train 'ner'
    with nlp.disable_pipes(*pipes):  # only train NER
        optimizer = nlp.begin_training()
        for itn in range(timeshowntochatbot):
            print("Starting iteration " + str(itn))
            random.shuffle(traindata)
            losses = {}
            for text, annotations in traindata:
                nlp.update([text], [annotations], drop=0.2, sgd=optimizer, losses=losses)
            print(losses)
    return nlp


recognize_entities("I would like an appointment with doctor Tim")

# https://towardsdatascience.com/named-entity-recognition-with-nltk-and-spacy-8c4a7d88e7da

# https://towardsdatascience.com/custom-named-entity-recognition-using-spacy-7140ebbb3718

# https://medium.com/@manivannan_data/how-to-train-ner-with-custom-training-data-using-spacy-188e0e508c6

# https://spacy.io/usage/spacy-101