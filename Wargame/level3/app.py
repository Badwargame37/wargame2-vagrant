from flask import Flask, request, render_template, redirect, url_for
import os
app = Flask(__name__)

@app.route('/', methods=['GET', 'POST'])
def login():
    return render_template('login.html')

@app.route('/check', methods=['POST'])
def check():
    username = request.form['username']
    password = request.form['password']
    
    if username == "admin" and password == "tintin":
        return render_template('home.html')
    else:
        return "Wrong credentials, are you sure you're not a toaster?"



if __name__ == "__main__":

    port = int(os.environ.get('PORT', 8083))
    app.run(debug=False, host='0.0.0.0', port=port)
