import json
import numpy as np
from nltk.util import ngrams
from collections import Counter, defaultdict, namedtuple

Tag = namedtuple("Tag", ["token", "tag"])
LAPLACE = 0.0000001


def load_sequences(filename, sep="\t", encoding='utf-8'):
    sequences = []
    with open(filename, encoding=encoding) as fp:
        seq = []
        for line in fp:
            line = line.strip()
            if line:
                line = line.split(sep)
                seq.append(Tag(*line))
            else:
                sequences.append(seq)
                seq = []
        if seq:
            sequences.append(seq)
    return sequences


def generate_emission_matrix(x, y, with_context=False, laplace_factor=LAPLACE):
    word_tag_count = defaultdict(lambda: 0)
    tag_count = defaultdict(lambda: 0)

    for line, tags in zip(x, y):
        prev_tag = '*'
        for word, tag in zip(line, tags):
            if with_context:
                tag_count[(tag, prev_tag)] += 1
                word_tag_count[(word, tag, prev_tag)] += 1
            else:
                tag_count[(tag,)] += 1
                word_tag_count[(word, tag)] += 1
            prev_tag = tag

    emission_matrix = defaultdict(lambda: laplace_factor)

    for word_tags in word_tag_count.keys():
        tags = word_tags[1:]
        emission_matrix[word_tags] = word_tag_count[word_tags] / \
            tag_count[tags]

    return emission_matrix


def generate_transition_matrix(y, ngram=2, laplace_factor=LAPLACE):
    ngram_tags = []
    for tag_list in y:
        tag_list = ["*"] * (ngram - 1) + tag_list + ["STOP"]
        ngram_tags.extend(ngrams(tag_list, ngram))
    ngram_count = dict(Counter(ngram_tags))

    n_minus_1_gram_tags = []
    for tag_list in y:
        tag_list = ["*"] * (ngram - 1) + tag_list + ["STOP"]
        n_minus_1_gram_tags.extend(ngrams(tag_list, ngram - 1))
    n_minus_1_gram_count = dict(Counter(n_minus_1_gram_tags))

    transition_matrix = defaultdict(lambda: laplace_factor)

    for ngram_tuple in ngram_count:
        n_minus_1_gram_tuple = ngram_tuple[:-1]
        transition_matrix[ngram_tuple] = ngram_count[ngram_tuple] / \
            n_minus_1_gram_count[n_minus_1_gram_tuple]

    return transition_matrix
