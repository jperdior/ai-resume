# AI Resume

## Introduction

This is an interactive AI powered resume built on top of Symfony and a very simple vue.js frontend.
In a few steps and with an OpenAI API key, you can set up your own interactive resume.

## Requirements

- docker
- docker-compose
- make
- python3
- OpenAI API key
- Ports 8080, 5173, 27017 and 8888 available

## Get it running

1. Clone this repository
2. Set your OpenAI API key in the ops/docker/docker-compose.dev.yml file line 8
3. Set your OpenAI API key in the code/embedding/embedding.py file line 5
4. Run `make start` 
5. Run `make open-ui`, if this doesn't work, open http://localhost:5173 in your browser

## How to use

### Prepare your resume data

1. Open the file code/embedding/resume.txt
2. Fill in your resume data in the following format:
```
Name: Your name
_____
Awesome fact about you 1
_____
Awesome fact about you 2
_____
Awesome fact about you 3
```
Feel free to add any relevant info about you, but keep in mind that the AI will only be able to answer questions about the facts you provide.
3. Run `make update-embeddings`. This will embed your resume data and store it in the infrastructure layer of the symfony project as raw data.

And that's it! You can now go to the browser and ask questions about your resume.

## Roadmap

- Create a better frontend template
- Add tests
- Rewrite the embedding update functionality as a symfony Command so the host doesn't need to have python installed
or
- Create a docker image for the embedding update functionality

