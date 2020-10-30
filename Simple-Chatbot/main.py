import nltk
from nltk.stem.lancaster import LancasterStemmer

# Create a new stemmer. Takes the root word from a word.
stemmer = LancasterStemmer()

import numpy
import tflearn
import tensorflow
import random
import json
import pickle

trainable = True

# Import the intents.
with open('intents.json') as file: data = json.load(file)

if not trainable:
    try:
        with open('data.pickle', 'rb') as f:
            words, labels, training, output = pickle.load(f)
    except:
        trainable = True

if trainable:
    words = []  # The root words.
    labels = []  # The tags.
    docs_patterns = []  # The patterns (list).
    docs_labels = []  # Will contain each tag but as the amount of how many times the tag exists.

    for intent in data['intents']:
        for pattern in intent['patterns']:
            # Get all the words from the patterns -> words[].
            words_pattern = nltk.word_tokenize(pattern)
            words.extend(words_pattern)

            # Get all the patterns -> docs_patterns[].
            docs_patterns.append(words_pattern)

            # Get the tag from the pattern -> docs_labels[].
            docs_labels.append(intent["tag"])

        # Append each label one time in list labels
        if intent['tag'] not in labels:
            labels.append(intent['tag'])

    # Stem the words(get root word) and remove duplicates -> words[].
    words = [stemmer.stem(word.lower()) for word in words]

    # Sort the labels & words
    words = sorted(list(set(words)))
    labels = sorted(labels)

    # Will contain a list of bag of words that contains 0 and 1.
    training = []

    # Wil contain a list of 0 and 1.
    output = []

    # out_empty = [0, 0, 0, 0, 0, ...]
    out_empty = [0 for _ in range(len(labels))]

    for x, doc in enumerate(docs_patterns):
        # Bag of words
        bag = []

        # Convert each word to root word
        root_words_from_doc = [stemmer.stem(word.lower()) for word in doc]

        # Represent words as 0 and 1 in the bag.
        for word in words:
            if word in root_words_from_doc:
                bag.append(1)
            else:
                bag.append(0)

        # Represent labels as 0 and 1
        output_row = out_empty[:]
        output_row[labels.index(docs_labels[x])] = 1

        training.append(bag)
        output.append(output_row)

    training = numpy.array(training)
    output = numpy.array(output)

    # Save the words, labels, training & output data to the data.pickle file.
    with open('data.pickle', 'wb') as f:
        pickle.dump((words, labels, training, output), f)

# Reset the underlying graph data
tensorflow.reset_default_graph()


# AI part. Neural network connections.
network = tflearn.input_data(shape=[None, len(training[0])]) # Define the input shape we are expecting for the model.
network = tflearn.fully_connected(network, 8) # Add a fully connected layer to our neural network layer.
network = tflearn.fully_connected(network, 8) # Same thing for the second one.
network = tflearn.fully_connected(network, len(output[0]), activation="softmax") # Output layer. Allows us to get probabilities for the output.
network = tflearn.regression(network)

# Train the model.
model = tflearn.DNN(network)

if not trainable:
    try:
        model.load("model.tflearn")
    except:
        model.fit(training, output, n_epoch=1000, batch_size=8, show_metric=True)
        model.save("model.tflearn")
else:
    # Give the model the training data. epoch(how many times it sees the data).
    model.fit(training, output, n_epoch=1000, batch_size=8, show_metric=True)
    model.save("model.tflearn")


def bag_of_words(input_user, words):
    bag = [0 for _ in range(len(words))]

    user_input_words = nltk.word_tokenize(input_user)
    user_input_words = [stemmer.stem(word.lower()) for word in user_input_words]

    for user_input_word in user_input_words:
        for i, word in enumerate(words):
            if word == user_input_word:
                bag[i] = 1

    return numpy.array(bag)


def chat():
    print("Start talking with the bot (type leave to stop)!")
    while True:
        try:
            input_user = input("You: ")
            if input_user.lower() == "leave":
                break

            results = model.predict([bag_of_words(input_user, words)])[0]
            results_index = numpy.argmax(results)
            tag = labels[results_index]

            if results[results_index] > 0.7:
                for tg in data["intents"]:
                    if tg['tag'] == tag:
                        responses = tg['responses']
                print(random.choice(responses))
            else:
                print("I am sorry, I didn't understand you")

        except UnboundLocalError as e:
            print("Some error occurred: {}".format(e))

chat()

# Links geraadpleegd op 18/10
# https://techwithtim.net/tutorials/ai-chatbot/part-1/
# 	-> https://www.youtube.com/watch?v=wypVcNIH6D4
# 	-> https://www.youtube.com/watch?v=ON5pGUJDNow
# 	-> https://www.youtube.com/watch?v=PzzHOvpqDYs
# 	-> https://www.youtube.com/watch?v=ICL7VRKvS_A
# 	-> https://www.youtube.com/watch?v=jBXAi-Vm_-g
