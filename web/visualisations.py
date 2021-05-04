#!C:/Users/camer/python.exe

# imports
import pandas as pd
import mysql.connector
import spacy
from nltk.stem import PorterStemmer


# function declarations

# get papers
def getPapers():
    connection = mysql.connector.connect(
        host="localhost",
        user="root",
        password="password",
        database="mysql"
    )

    # return papers into a pandas dataframe
    return pd.read_sql("SELECT id, title, author, abstract FROM papers", con=connection)

# to lowercase
def toLower(text):
    return text.astype(str).str.lower()

# function to tokenise text
def tokenise(text):
    sp = spacy.load("en_core_web_sm")
    return text.apply(lambda x: sp(x))

# function to remove punctuation instances
def removePunctuation(text):
    return text.str.replace('[^\w\s]','')

# function to remove stop words
def removeStops(text):
    sp = spacy.load("en_core_web_sm")
    stops = sp.Defaults.stop_words
    return [word for word in text if not word in stops]

# calculates and prints the similarity of documents
def getSimilarity(id, set):
    length = len(set)
    doc1 = set['abstract'].loc[0]
    print("Similarities to Document " + str(id+1))
    i = 0
    while i < length:
        if i != id:
            doc2 = set['abstract'].loc[i]
            print("Document " + str(i+1) + ", Title: " + str(set['title'].loc[i]) + ", Similarity: " + str(doc1.similarity(doc2)))
        i = i + 1
		
def main():
	# get the papers into a pandas dataframe
	dfPapers = getPapers()
	
	# data preprocessing
	# forcing relevant fields to lowercase
	dfPapers["title"] = toLower(dfPapers["title"])
	dfPapers["abstract"] = toLower(dfPapers["abstract"])

	# remove punctuation
	dfPapers['title'] = removePunctuation(dfPapers['title'])
	dfPapers['abstract'] = removePunctuation(dfPapers['abstract'])

	# tokenise relevant data
	dfPapers['title'] = tokenise(dfPapers['title'])
	dfPapers['abstract'] = tokenise(dfPapers['abstract'])

	# remove stop words
	dfPapers['title'] = removeStops(dfPapers['title'])
	dfPapers['abstract'] = removeStops(dfPapers['abstract'])
	
	# calculate and display cosine similarity for document 1
	getSimilarity(0, dfPapers)

# execute code
main()
