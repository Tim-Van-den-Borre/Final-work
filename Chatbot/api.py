from main import chat
from flask import Flask, jsonify, request
from flask_restful import Resource, Api
from flask_cors import CORS
import requests
app = Flask(__name__)
CORS(app)
api = Api(app)


@app.route('/', methods=['GET'])
def get():
    return request.get_json()

@app.route('/postUserId', methods=['POST'])
def postUserId():
    data = request.get_json()
    return data


@app.route('/chat', methods=['POST'])
def post():
    try:
        data = request.get_json()
        userdata = chat(data)
        response = jsonify({
                "patient": userdata['UserID'],
                "doctor": userdata['Data']['doctor'],
                "reason": userdata['Data']['reason'],
                "date": userdata['Data']['date'],
                "time": userdata['Data']['time'],
                "message": userdata["Message"]
            })

        response.headers.add('Access-Control-Allow-Origin', '*')
    except:
        response = jsonify({"message": "Error has occured"})
        response.headers.add('Access-Control-Allow-Origin', '*')

    return response


@app.route('/firstmessage', methods=['GET'])
def firstMessage():
    try:
        response = jsonify("Hi, my name is Tim. How can i be of service to you?")
        print(response)
        response.headers.add('Access-Control-Allow-Origin', '*')
    except:
        response = jsonify({"message": "Error has occured"})
        response.headers.add('Access-Control-Allow-Origin', '*')

    return response


if __name__ == '__main__':
    app.run(debug=False)

# Flask API. Geraadpleegd op 24/11.
# https://opensource.com/article/19/11/python-web-api-flask
# https://www.digitalocean.com/community/tutorials/processing-incoming-request-data-in-flask
# https://www.kite.com/blog/python/flask-restful-api-tutorial/
