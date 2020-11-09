from transformers import pipeline
classifier = pipeline('sentiment-analysis')

def chat():
    print('Welcome, you are now talking with the bot!')

    while True:
        user_input =input(">>> ")
        if user_input.lower() == "leave":
            break

        results = classifier([user_input])
        for result in results:
            print(f"label: {result['label']}, with score: {round(result['score'], 4)}")

chat()