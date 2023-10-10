from flask import Flask, render_template
import os

app = Flask(__name__, static_folder='static')

@app.route('/', methods=['POST', 'GET'])
def home():
    return render_template('index.html')

if __name__ == "__main__":
    port = int(os.environ.get('PORT', 8082))
    app.run(debug=False, host='0.0.0.0', port=port)
