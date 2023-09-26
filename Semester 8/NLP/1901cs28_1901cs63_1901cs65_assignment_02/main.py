# 1901CS39_1901CS46_1901CS72
# NLP CS563
# Assignment 2 NER

import numpy as np
import string
from sklearn.metrics import f1_score, precision_score, recall_score, accuracy_score
from sklearn.model_selection import KFold

DATA_PATH = "NER_Dataset/NER-Dataset-Train.txt"
TEST_PATH = "NER_Dataset/NER-Dataset-Test.txt"

np.set_printoptions(precision=4)


class MY_HMM:

    def dataset(self, lines):
        #word_tag_list is a two dimensional array that holds words and their corresponding tags
        word_tag_list = [
        ]  # [['EU', 'B'], ['rejects', 'O'], ['German', 'B'], ['call', 'O'], ['to', 'O'],...]]
        #sentence_tags holds tag sequences for every sentence
        sentence_tags = [
        ]  # ['<s> B O B O O O B O O </s>', '<s> B I </s>', ...]
        sent = "<s> "

        for line in lines:

            if (line != '\n'):
                items = line.split()
                word_tag_list.append([items[0], items[1]])
                sent += items[1] + " "
            else:
                sent += "</s>"
                sentence_tags.append(sent)
                sent = "<s> "

        return sentence_tags, word_tag_list

    def HMM(self, lines):
        sentence_tags, word_tag_list = self.dataset(lines)
        #trans_probs ans emis_probs are nested dictionaries
        #trans_probs holds tags and count of its following tags
        #emis_probs hols holds tags and words that used with this tag
        trans_probs = {
        }  #{"B" : {'O': 5943, 'I': 1041, '</s>': 110, 'B': 10, 'B': 27, 'B': 1, 'B': 8}, "O" :{...}}
        emis_probs = {
        }  #{"B" : {'brussels': 31, 'germany': 142, 'britain': 134, 'france': 123,...}, "O" :{...}}
        start_probs = {}
        #tag_list is like set, includes tag types and word boundaries
        tag_list = []
        tag_list.append("<s>")

        for sent in sentence_tags:
            tags = sent.split()
            # print('tags = ', tags)
            for i in range(len(tags) - 1):
                if (tags[i] not in trans_probs.keys()):
                    trans_probs[tags[i]] = {tags[i + 1]: 1}
                else:
                    if (tags[i + 1] not in trans_probs[tags[i]].keys()):
                        trans_probs[tags[i]][tags[i + 1]] = 1
                    else:
                        trans_probs[tags[i]][tags[i + 1]] += 1

        for word_tag in word_tag_list:
            word_tag[0] = word_tag[0].lower()
            if (word_tag[1] not in emis_probs):
                emis_probs[word_tag[1]] = {word_tag[0]: 1}
            else:
                if (word_tag[0] not in emis_probs[word_tag[1]].keys()):
                    emis_probs[word_tag[1]][word_tag[0]] = 1
                else:
                    emis_probs[word_tag[1]][word_tag[0]] += 1
            if (word_tag[1] not in tag_list):
                tag_list.append(word_tag[1])

        tag_list.append("</s>")
        
        for sent in sentence_tags:
            tag = sent[4]
            if tag == "<":
                continue
            if tag not in start_probs:
                start_probs[tag] = 1
            else:
                start_probs[tag]+=1
    
        for i in start_probs:
            start_probs[i] /= len(sentence_tags)
        
        return tag_list, trans_probs, emis_probs, start_probs



mm = MY_HMM()


def viterbi(train_lines, test_lines):
    tag_list, trans_probs, emis_probs, start_probs = mm.HMM(train_lines)

    number_of_tag = len(emis_probs)
    # predicted_tags is 2d array, it includes predicted tag sequences for every sentence
    predicted_tags = [
    ]  #[['<s>', 'O', 'O', 'B', 'O', 'I', 'O', 'O', 'B', 'O', 'O', 'O', 'O', '</s>'], ['<s>', 'B',...], ...]

    sent = ""
    for line in test_lines:

        if (line != '\n' and line.split()[0] != "-DOCSTART-"):
            sent += line.split()[0] + " "

        elif (sent != "" and line == '\n'):

            sent = "<s> " + sent.lower() + "</s>"
            words = sent.split()
            matrix = np.zeros((number_of_tag + 2, len(words)))
            matrix[0][0] = 1

            for i in range( 1, len(tag_list) -2):
                if words[1] in emis_probs[tag_list[i]] and tag_list[i] in start_probs:
                    matrix[i][1] = start_probs[tag_list[i]]*(emis_probs[tag_list[i]][words[1]]/sum(emis_probs[tag_list[i]].values()))

            for w in range(1, len(words) - 1):
                for i in range(1, len(tag_list) - 1):
                    emission_probability = 0
                    transition_probability = 0
                    final_probability = 0

                    token = words[w]
                    curr_tag = tag_list[i]

                    if (token in emis_probs[curr_tag].keys()):
                        emission_probability = (
                            emis_probs[curr_tag][token] + 1) / (sum(
                                emis_probs[curr_tag].values()) + number_of_tag)
                    else:
                        emission_probability = 1 / (
                            sum(emis_probs[curr_tag].values()) + number_of_tag)

                    # for first token, do not consider previous probabilities
                    if (token == words[1]):
                        if ("<s>" in trans_probs.keys()):
                            if (curr_tag in trans_probs["<s>"].keys()):
                                transition_probability = (
                                    trans_probs["<s>"][curr_tag] +
                                    1) / (sum(trans_probs["<s>"].values()) +
                                          number_of_tag)
                            else:
                                transition_probability = (0 + 1) / (
                                    sum(trans_probs["<s>"].values()) +
                                    number_of_tag)

                        matrix[i][
                            w] = transition_probability * emission_probability

                    else:
                        for t in range(1, len(tag_list) - 1):
                            query_tag = tag_list[t]
                            if (query_tag in trans_probs.keys()):
                                if (curr_tag in trans_probs[query_tag].keys()):
                                    transition_probability = (
                                        trans_probs[query_tag][curr_tag] + 1
                                    ) / (sum(trans_probs[query_tag].values()) +
                                         number_of_tag)
                                else:
                                    transition_probability = (0 + 1) / (
                                        sum(trans_probs[query_tag].values()) +
                                        number_of_tag)

                            final_probability = transition_probability * emission_probability * matrix[
                                t][w - 1]

                            if (final_probability > matrix[i][w]):
                                matrix[i][w] = final_probability

                    # if tokens are finished, fill end of sentence probability
                    if (w == len(words) - 2 and i == len(tag_list) - 2):
                        for t in range(1, len(tag_list) - 1):
                            query_tag = tag_list[t] 
                            if (query_tag in trans_probs.keys()):
                                if ("</s>" in trans_probs[query_tag].keys()):
                                    transition_probability = (
                                        trans_probs[query_tag]["</s>"] + 1
                                    ) / (sum(trans_probs[query_tag].values()) +
                                         number_of_tag)
                                else:
                                    transition_probability = (0 + 1) / (
                                        sum(trans_probs[query_tag].values()) +
                                        number_of_tag)
                            final_probability = matrix[t][
                                w] * transition_probability

                            if (final_probability > matrix[i + 1][w + 1]):
                                matrix[i + 1][w + 1] = final_probability

                sent = ""

            # after obtaining final matrix, backtrace and extract predicted tags
            result = np.amax(matrix, axis=0)
            predicted_tags_word = []
            for maxval in result:
                r, c = np.where(matrix == maxval)
                predicted_tags_word.append(tag_list[r[0]])

            predicted_tags.append(predicted_tags_word)
    return predicted_tags


def accuracy(train_lines, test_lines):
  predicted_sequence = viterbi(train_lines, test_lines)
  # gold_sequence is 2d array, it includes gold tag sequences for every sentence
  gold_sequence = [
  ]  #[['<s>', 'O', 'O', 'B', ...], ['<s>', 'B-',...], ...]

  seq = ["<s>"]
  i = 0
  for line in test_lines:
    i += 1
    if (line != '\n' and line.split()[0] != "-DOCSTART-"):
      gold_tag = line.split()[1]
      seq.append(gold_tag)

    elif (line == '\n' and seq != ["<s>"]):
      seq.append("</s>")
      gold_sequence.append(seq)
      seq = ["<s>"]

  true_tag_count = 0
  tag_count = 0
  tp,tn,fp,fn=0,0,0,0
  y_true=[]
  y_pred=[]
  for i in range(len(gold_sequence)):
    if (len(predicted_sequence[i]) == len(gold_sequence[i])):
      for k in range(len(gold_sequence[i])):
        if(gold_sequence[i][k]=='<s>' or gold_sequence[i][k]=='</s>'):
            continue
        y_true.append(gold_sequence[i][k])
        y_pred.append(predicted_sequence[i][k])
#   print(y_true,y_pred)
  temp=set(y_true)
  temp1=set(y_pred)
#   print(temp,temp1)
  f1 = f1_score(y_true, y_pred, labels=['I','B','O'], average=None)
  precision = precision_score(y_true, y_pred, labels=['I','B','O'], average=None)
  recall = recall_score(y_true, y_pred, labels=['I','B','O'], average=None)
  accuracy = accuracy_score(y_true,y_pred)
  return accuracy, precision, recall, f1
  #return f1


dataset = open('NER_Dataset/NER-Dataset-Train.txt','r')

lines = dataset.readlines()
sentence_indices = [0]
total_sentences = 0

import random
# lines=np.array(lines)
kf = KFold(n_splits=5)

c=0

precision_list = []
f1_list = []
recall_list = []

total_accuracy = 0

for train_index,test_index in kf.split(lines):
    train_lines=[]
    test_lines=[]
    for i in train_index:
      train_lines.append(lines[i])
    for i in test_index:
      test_lines.append(lines[i])
    final_accuracy,final_precision,final_recall,final_f1 = accuracy(train_lines, test_lines)

    f1_list.append(final_f1)
    recall_list.append(final_recall)
    precision_list.append(final_precision)
    total_accuracy += final_accuracy
    c += 1
    print('\n\n')
    print(f"Iteration {c}")
    print("---------------")
    print("Accuracy = ", final_accuracy)
    print("Precision = ", final_precision)
    print("Recall = ", final_recall)
    print("F1_score = ", final_f1)
    print('\n\n')



def average(ls, str):
    total = [0, 0, 0]
    for i in range(0, 5):
        for j in range(0, 3):
            total[j] += ls[i][j]
    for i in range(0, 3): 
        total[i] /= 5
    print('Average ', str, ' = ', total)

print('Average Accuracy = ', total_accuracy/5)
average(precision_list, 'Precision')
average(recall_list, 'Recall')
average(f1_list, 'F1 Score')


test_dataset = open('NER_Dataset/NER-Dataset-Test.txt','r')

test_lines = test_dataset.readlines()

predicted_tags= viterbi(lines,test_lines)


def convert_to_sentence(array):
  sentence=""
  for word in array:
    sentence+=word+" "
  return sentence
total=len(predicted_tags)
sentences=[]
temp=""

for line in test_lines:
  line=line.strip()
  if(line==""):
    sentences.append(temp)
    temp=""
  else:
    temp+=line+" "

with open('predicted.txt', 'w') as f:
  for c in range(0,total):
      f.write('sentence:\n')
      for word in sentences[c]:
        f.write(word)
      f.write('\n')
      f.write('predicted_sequence:\n')
      prediction=convert_to_sentence(predicted_tags[c])
      f.write(prediction)
      f.write('\n\n')


