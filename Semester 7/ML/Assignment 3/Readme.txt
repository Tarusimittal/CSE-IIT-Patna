#Tarusi Mittal
#1901CS65

#### Transition Matrix

##### Bigram Case

To estimate `A[i][j]`, where `A[i][j]` denotes the probability of tag `j` succeeding tag `i`.


A[i][j] = freq(i, j) / freq(i)


##### Trigram Case

To estimate `A[i][j][k]`, where `A[i][j][k]` denotes the probability of tag `k` succeeding tag `j` succeeding tag `i`.


A[i][j] = freq(i, j, k) / freq(i, j)


#### Emission Matrix

##### Without Context Case

To estimate `B[i][j]`, where `B[i][j]` denotes the probability of word/token `i` emitting from tag `j`.


B[i][j] = freq(i, j) / freq(j)


##### With Context Case

To estimate `B[i][j][k]`, where `B[i][j][k]` denotes the probability of word/token `i` emitting from tag `j` preceded by tag `k`.


B[i][j][k] = freq(i, j, k) / freq(j, k)


These parameters being obtained, our model is now trained for usage on test cases.

### The Viterbi Algorithm

For evaluation, we use the Viterbi algorithm. The algorithm uses Dynamic Programming to estimate the probability of most probable sequence of tags and then reconstructs the corresponding sequence using stored data.

## For 1st fold

Evaluation on bigram model without context
100%|████████████████████████████████████████████████████████████████████████████████████████████████| 180/180 [00:00<00:00, 2957.14it/s]
Accuracy of the model: 0.9484593837535014
| Class | Precision | Recall | F1 |
|---------+-------------+----------+----------|
| B | 0.566667 | 0.146552 | 0.232877 |
| I | 0.615385 | 0.101266 | 0.173913 |
| O | 0.952935 | 0.995852 | 0.973921 |

Evaluated 180 sentences.

---

Evaluation on trigram model without context
100%|█████████████████████████████████████████████████████████████████████████████████████████████████| 180/180 [00:00<00:00, 632.18it/s]
Accuracy of the model: 0.9484593837535014
| Class | Precision | Recall | F1 |
|---------+-------------+----------+----------|
| B | 0.571429 | 0.137931 | 0.222222 |
| I | 0.642857 | 0.113924 | 0.193548 |
| O | 0.952664 | 0.995852 | 0.97378 |

Evaluated 180 sentences.

---

Evaluation on bigram model with context
100%|████████████████████████████████████████████████████████████████████████████████████████████████| 180/180 [00:00<00:00, 2471.56it/s]
Accuracy of the model: 0.949859943977591
| Class | Precision | Recall | F1 |
|---------+-------------+----------+----------|
| B | 0.655172 | 0.163793 | 0.262069 |
| I | 0.545455 | 0.151899 | 0.237624 |
| O | 0.954817 | 0.995556 | 0.974761 |

Evaluated 180 sentences.

---

Evaluation on trigram model with context
100%|█████████████████████████████████████████████████████████████████████████████████████████████████| 180/180 [00:00<00:00, 598.95it/s]
Accuracy of the model: 0.9484593837535014
| Class | Precision | Recall | F1 |
|---------+-------------+----------+----------|
| B | 0.642857 | 0.155172 | 0.25 |
| I | 0.448276 | 0.164557 | 0.240741 |
| O | 0.955024 | 0.994074 | 0.974158 |

Evaluated 180 sentences.

## For 2nd fold

Evaluation on bigram model without context
100%|████████████████████████████████████████████████████████████████████████████████████████████████| 180/180 [00:00<00:00, 3060.00it/s]
Accuracy of the model: 0.9341843971631205
| Class | Precision | Recall | F1 |
|---------+-------------+-----------+----------|
| B | 0.541667 | 0.0992366 | 0.167742 |
| I | 0.4375 | 0.0679612 | 0.117647 |
| O | 0.939168 | 0.994531 | 0.966057 |

Evaluated 180 sentences.

---

Evaluation on trigram model without context
100%|█████████████████████████████████████████████████████████████████████████████████████████████████| 180/180 [00:00<00:00, 620.21it/s]
Accuracy of the model: 0.9339007092198581
| Class | Precision | Recall | F1 |
|---------+-------------+-----------+----------|
| B | 0.541667 | 0.0992366 | 0.167742 |
| I | 0.421053 | 0.0776699 | 0.131148 |
| O | 0.939403 | 0.993923 | 0.965894 |

Evaluated 180 sentences.

---

Evaluation on bigram model with context
100%|████████████████████████████████████████████████████████████████████████████████████████████████| 180/180 [00:00<00:00, 2733.21it/s]
Accuracy of the model: 0.933049645390071
| Class | Precision | Recall | F1 |
|---------+-------------+-----------+----------|
| B | 0.52 | 0.0992366 | 0.166667 |
| I | 0.380952 | 0.0776699 | 0.129032 |
| O | 0.93935 | 0.993011 | 0.965436 |

Evaluated 180 sentences.

---

Evaluation on trigram model with context
100%|█████████████████████████████████████████████████████████████████████████████████████████████████| 180/180 [00:00<00:00, 617.89it/s]
Accuracy of the model: 0.933049645390071
| Class | Precision | Recall | F1 |
|---------+-------------+-----------+----------|
| B | 0.52 | 0.0992366 | 0.166667 |
| I | 0.380952 | 0.0776699 | 0.129032 |
| O | 0.93935 | 0.993011 | 0.965436 |

Evaluated 180 sentences.

## For 3rd fold

Evaluation on bigram model without context
100%|████████████████████████████████████████████████████████████████████████████████████████████████| 180/180 [00:00<00:00, 3007.96it/s]
Accuracy of the model: 0.9460484106153397
| Class | Precision | Recall | F1 |
|---------+-------------+----------+----------|
| B | 0.608696 | 0.12069 | 0.201439 |
| I | 0.9 | 0.195652 | 0.321429 |
| O | 0.948612 | 0.997206 | 0.972302 |

Evaluated 180 sentences.

---

Evaluation on trigram model without context
100%|█████████████████████████████████████████████████████████████████████████████████████████████████| 180/180 [00:00<00:00, 686.25it/s]
Accuracy of the model: 0.9454651501895597
| Class | Precision | Recall | F1 |
|---------+-------------+----------+----------|
| B | 0.608696 | 0.12069 | 0.201439 |
| I | 0.769231 | 0.217391 | 0.338983 |
| O | 0.949112 | 0.995964 | 0.971974 |

Evaluated 180 sentences.

---

Evaluation on bigram model with context
100%|████████████████████████████████████████████████████████████████████████████████████████████████| 180/180 [00:00<00:00, 2775.42it/s]
Accuracy of the model: 0.9480898221055701
| Class | Precision | Recall | F1 |
|---------+-------------+----------+----------|
| B | 0.708333 | 0.146552 | 0.242857 |
| I | 0.827586 | 0.26087 | 0.396694 |
| O | 0.950829 | 0.996585 | 0.97317 |

Evaluated 180 sentences.

---

Evaluation on trigram model with context
100%|█████████████████████████████████████████████████████████████████████████████████████████████████| 180/180 [00:00<00:00, 573.20it/s]
Accuracy of the model: 0.9477981918926801
| Class | Precision | Recall | F1 |
|---------+-------------+----------+----------|
| B | 0.727273 | 0.137931 | 0.231884 |
| I | 0.827586 | 0.26087 | 0.396694 |
| O | 0.950266 | 0.996585 | 0.972875 |

Evaluated 180 sentences.

## For 4th fold

Evaluation on bigram model without context
100%|████████████████████████████████████████████████████████████████████████████████████████████████| 180/180 [00:00<00:00, 3164.32it/s]
Accuracy of the model: 0.9584991472427515
| Class | Precision | Recall | F1 |
|---------+-------------+-----------+----------|
| B | 0.64 | 0.149533 | 0.242424 |
| I | 0.8 | 0.0754717 | 0.137931 |
| O | 0.961009 | 0.998213 | 0.979258 |

Evaluated 180 sentences.

---

Evaluation on trigram model without context
100%|█████████████████████████████████████████████████████████████████████████████████████████████████| 180/180 [00:00<00:00, 663.46it/s]
Accuracy of the model: 0.9587833996588971
| Class | Precision | Recall | F1 |
|---------+-------------+-----------+----------|
| B | 0.695652 | 0.149533 | 0.246154 |
| I | 0.8 | 0.0754717 | 0.137931 |
| O | 0.960745 | 0.998511 | 0.979264 |

Evaluated 180 sentences.

---

Evaluation on bigram model with context
100%|████████████████████████████████████████████████████████████████████████████████████████████████| 180/180 [00:00<00:00, 2652.77it/s]
Accuracy of the model: 0.9559408754974418
| Class | Precision | Recall | F1 |
|---------+-------------+-----------+----------|
| B | 0.684211 | 0.121495 | 0.206349 |
| I | 0.333333 | 0.0754717 | 0.123077 |
| O | 0.959564 | 0.996426 | 0.977648 |

Evaluated 180 sentences.

---

Evaluation on trigram model with context
100%|█████████████████████████████████████████████████████████████████████████████████████████████████| 180/180 [00:00<00:00, 643.53it/s]
Accuracy of the model: 0.9559408754974418
| Class | Precision | Recall | F1 |
|---------+-------------+-----------+----------|
| B | 0.684211 | 0.121495 | 0.206349 |
| I | 0.333333 | 0.0754717 | 0.123077 |
| O | 0.959564 | 0.996426 | 0.977648 |

Evaluated 180 sentences.

## For 5th fold

Evaluation on bigram model without context
100%|████████████████████████████████████████████████████████████████████████████████████████████████| 181/181 [00:00<00:00, 3183.89it/s]
Accuracy of the model: 0.9476439790575916
| Class | Precision | Recall | F1 |
|---------+-------------+----------+----------|
| B | 0.47619 | 0.178571 | 0.25974 |
| I | 0.333333 | 0.142857 | 0.2 |
| O | 0.958445 | 0.98958 | 0.973764 |

Evaluated 181 sentences.

---

Evaluation on trigram model without context
100%|█████████████████████████████████████████████████████████████████████████████████████████████████| 181/181 [00:00<00:00, 610.97it/s]
Accuracy of the model: 0.9470622454915648
| Class | Precision | Recall | F1 |
|---------+-------------+----------+----------|
| B | 0.452381 | 0.169643 | 0.246753 |
| I | 0.321429 | 0.142857 | 0.197802 |
| O | 0.958432 | 0.989274 | 0.973609 |

Evaluated 181 sentences.

---

Evaluation on bigram model with context
100%|████████████████████████████████████████████████████████████████████████████████████████████████| 181/181 [00:00<00:00, 2452.53it/s]
Accuracy of the model: 0.9508435136707388
| Class | Precision | Recall | F1 |
|---------+-------------+----------+----------|
| B | 0.611111 | 0.196429 | 0.297297 |
| I | 0.407407 | 0.174603 | 0.244444 |
| O | 0.958815 | 0.991725 | 0.974992 |

Evaluated 181 sentences.

---

Evaluation on trigram model with context
100%|█████████████████████████████████████████████████████████████████████████████████████████████████| 181/181 [00:00<00:00, 608.65it/s]
Accuracy of the model: 0.9514252472367656
| Class | Precision | Recall | F1 |
|---------+-------------+----------+----------|
| B | 0.628571 | 0.196429 | 0.29932 |
| I | 0.44 | 0.174603 | 0.25 |
| O | 0.958555 | 0.992338 | 0.975154 |

Evaluated 181 sentences.
