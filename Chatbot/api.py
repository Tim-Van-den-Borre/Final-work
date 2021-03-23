from main import chat
from flask import Flask, jsonify, request
from flask_restful import Resource, Api
from flask_cors import CORS

app = Flask(__name__)
CORS(app)
api = Api(app)


@app.route('/', methods=['GET'])
def get():
    return request.get_json()


@app.route('/chat', methods=['POST'])
def post():
    try:
        data = request.get_json()
        print(data)
        response = jsonify(chat(data["Message"]))
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
