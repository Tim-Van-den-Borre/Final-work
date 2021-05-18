import json

import requests
from flask import jsonify

import entity_recognition
import nltk
import numpy
import pickle
import random
import tflearn

from nltk.stem.lancaster import LancasterStemmer

# Create a new stemmer. Takes the root word from a word.
stemmer = LancasterStemmer()

# Import the intents.
with open('intents.json') as file:
    data = json.load(file)

# Load the model made from intents.json. If found the model is not fully retrained.
try:
    with open('data.pickle', 'rb') as model:
        words, tags, training, output = pickle.load(model)
    trainable = False
except IOError:
    trainable = True

if trainable:
    words = []  # The root words.
    tags = []  # The tags.
    patterns = []  # The patterns (list).
    taglist = []  # Will contain each tag but as the amount of how many times the tag exists.

    for intent in data['intents']:
        for pattern in intent['patterns']:
            # Get all the words from the patterns -> words[].
            pattern_words = nltk.word_tokenize(pattern)
            words.extend(pattern_words)

            # Get all the patterns -> patterns[].
            patterns.append(pattern_words)

            # Get the tag from the pattern -> docs_labels[].
            taglist.append(intent["tag"])

        # Append each tag one time in list tags.
        if intent['tag'] not in tags:
            tags.append(intent['tag'])

    # Stem the words(get root word) and remove duplicates -> words[].
    words = [stemmer.stem(word.lower()) for word in words]

    # Sort the labels & words
    words = sorted(list(set(words)))
    tags = sorted(tags)

    # Will contain a list of bag of words that contains 0 and 1.
    training = []

    # Wil contain a list of 0 and 1.
    output = []

    # out_empty = [0, 0, 0, 0, 0, ...]
    out_empty = [0 for _ in range(len(tags))]

    for x, doc in enumerate(patterns):
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
        output_row[tags.index(taglist[x])] = 1

        training.append(bag)
        output.append(output_row)

    training = numpy.array(training)
    output = numpy.array(output)

    # Save the words, labels, training & output data to the data.pickle file.
    with open('data.pickle', 'wb') as f:
        pickle.dump((words, tags, training, output), f)

# AI part. Neural network connections.
network = tflearn.input_data(shape=[None, len(training[0])])  # Define the input shape we are expecting for the model.
network = tflearn.fully_connected(network, 8)  # Add a fully connected layer to our neural network layer.
network = tflearn.fully_connected(network, 8)  # Same thing for the second one.
network = tflearn.fully_connected(network, len(output[0]),
                                  activation="softmax")  # Output layer. Allows us to get probabilities for the output.
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


def chat(input):
    try:
        input_user = input
        input_user = fillAppointmentData(input_user)

        customAnswer = customResponse(input_user)

        if customAnswer == "":
            results = model.predict([bag_of_words(input_user['Message'], words)])[0]
            results_index = numpy.argmax(results)
            tag = tags[results_index]

            with open('responses.json') as json_file:
                data = json.load(json_file)

            random_response = random.randint(0, 3)

            response_chatbot = "{}".format(data[tag]['response'][random_response])
            input_user['Message'] = response_chatbot
            if results[results_index] > 0.7:
                return input_user
            else:
                return "{}".format(data['unclear']['response'][random_response])
        else:
            input_user['Message'] = customAnswer
            return input_user

    except UnboundLocalError as e:
        print("Some error occurred: {}".format(e))


def customResponse(input_user):
    if input_user['Data']['doctor'] == 'NOT FOUND':
        return "The given doctor has not been found. Please provide another name of a doctor..."

    if input_user['Data']['doctor'] and input_user['Data']['date'] and input_user['Data']['time'] and input_user['Data']['reason']:
        entities = entity_recognition.recognize_entities(input_user['Message'])  # entity recognition.
        if entities != {}:
            for key in entities:
                if key == 'approved':
                    requests.post("http://127.0.0.1:8000/chatbotCreateAppointment", json=input_user)
                    return "Appointment has been created."
                if key == 'declined':
                    input_user['Data']['doctor'] = ''
                    input_user['Data']['date'] = ''
                    input_user['Data']['time'] = ''
                    input_user['Data']['reason'] = ''

                    return "Appointment request has been canceled."
        return "Can i make an appointment with doctor " + input_user['Data']['doctor'] + " on " + input_user['Data']['date'] + "?"
    return ""


def fillAppointmentData(input_user):
    print(input_user)
    entities = entity_recognition.recognize_entities(input_user['Message'])  # entity recognition.

    if entities != {}:

        for key in entities:
            if key == 'name_doctor':
                input_user['Data']['doctor'] = entities[key]
            if key == 'appointment_reason':
                input_user['Data']['reason'] = entities[key]
            if key == 'appointment_hour':
                input_user['Data']['time'] = entities[key]
            if key == 'appointment_day':
                input_user['Data']['date'] = entities[key]

        response = requests.post("http://127.0.0.1:8000/validateChatbotData", json=input_user)
        res = response.json()

        input_user['Data']['patient'] = input_user['UserID']
        input_user['Data']['doctor'] = res['doctor']
        input_user['Data']['reason'] = res['reason']
        input_user['Data']['date'] = res['date']
        input_user['Data']['time'] = res['time']

    return input_user


def ChatForTraining():
    print("Start talking with the bot.")
    while True:
        try:
            input_user = input("> ")
            if input_user.lower() == "/leave":
                break

            entity_recognition.recognize_entities(input_user)  # entity recognition.

            results = model.predict([bag_of_words(input_user, words)])[0]
            results_index = numpy.argmax(results)
            tag = tags[results_index]

            with open('responses.json') as json_file:
                data = json.load(json_file)

            random_response = random.randint(0, 3)

            response_chatbot = "{}".format(data[tag]['response'][random_response])

            if results[results_index] > 0.7:
                print("Bot: " + response_chatbot)
            else:
                print("Bot: " + "{}".format(data['unclear']['response'][random_response]))

        except UnboundLocalError as e:
            print("Some error occurred: {}".format(e))

# Chatbot. Geraadpleegd op 18/10
# https://www.youtube.com/watch?v=wypVcNIH6D4
# https://www.youtube.com/watch?v=ON5pGUJDNow
# https://www.youtube.com/watch?v=PzzHOvpqDYs
# https://www.youtube.com/watch?v=ICL7VRKvS_A
# https://www.youtube.com/watch?v=jBXAi-Vm_-g

# Chatbot layout example. Geraadpleegd op 24/11
# https://dev.to/sylviapap/make-a-simple-chatbot-with-javascript-1gc

# Chatbot example
# https://towardsdatascience.com/how-to-create-a-chatbot-with-python-deep-learning-in-less-than-an-hour-56a063bdfc44
# https://towardsdatascience.com/how-to-build-your-own-chatbot-using-deep-learning-bb41f970e281
