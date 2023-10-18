import openai
from openai.embeddings_utils import get_embedding
import json

openai.api_key = "apikey"  # Replace with your API key

with open('resume.txt', 'r', encoding='utf-8') as file:
    file_content = file.read()

paragraphs = file_content.split('_____')
paragraphs = [paragraph.strip() for paragraph in paragraphs if paragraph]
embeddings_with_similarity = {}

embeddings = []

for paragraph in paragraphs:
    embedding = {}
    embedding["paragraph"] = paragraph
    embedding["embedding"] = get_embedding(paragraph, engine='text-embedding-ada-002')
    embeddings.append(embedding)

with open('resume.json', 'w', encoding='utf-8') as file:
    json.dump(embeddings, file, ensure_ascii=False, indent=4)

