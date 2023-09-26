import numpy as np
from copy import deepcopy
from helper_class import Matrix

BLANK_KEY = -1
PUZZLE_NUM_ROWS = 3
PUZZLE_NUM_COLS = 3


def up(curr_state: Matrix):
    self = deepcopy(curr_state)
    if self.blank[0] == PUZZLE_NUM_ROWS - 1:
        return None
    else:
        self.mat[self.blank] = self.mat[self.blank[0] + 1, self.blank[1]]
        self.blank = (self.blank[0] + 1, self.blank[1])
        self.mat[self.blank] = BLANK_KEY
        return self

def down(curr_state: Matrix):
    self = deepcopy(curr_state)
    if self.blank[0] == 0:
        return None
    else:
        self.mat[self.blank] = self.mat[self.blank[0] - 1, self.blank[1]]
        self.blank = (self.blank[0] - 1, self.blank[1])
        self.mat[self.blank] = BLANK_KEY
        return self

def left(curr_state: Matrix):
    self = deepcopy(curr_state)
    if self.blank[1] == PUZZLE_NUM_COLS - 1:
        return None
    else:
        self.mat[self.blank] = self.mat[self.blank[0], self.blank[1] + 1]
        self.blank = (self.blank[0], self.blank[1] + 1)
        self.mat[self.blank] = BLANK_KEY
        return self

def right(curr_state: Matrix):
    self = deepcopy(curr_state)
    if self.blank[1] == 0:
        return None
    else:
        self.mat[self.blank] = self.mat[self.blank[0], self.blank[1] - 1]
        self.blank = (self.blank[0], self.blank[1] - 1)
        self.mat[self.blank] = BLANK_KEY
        return self



def string_to_mat(str):
    mat = np.arange(9).reshape(3, 3)
    flag = 0
    i = 0
    while i < len(str):
        if str[i] == '-':
            mat[i//PUZZLE_NUM_ROWS, i%PUZZLE_NUM_COLS] = -1
            i = i + 1
            flag = 1
        else:
            if flag == 1:
                mat[(i-1)//PUZZLE_NUM_ROWS, (i-1)%PUZZLE_NUM_COLS] = int(str[i])
            else:
                mat[i//PUZZLE_NUM_ROWS, i%PUZZLE_NUM_COLS] = int(str[i])
        i = i + 1
    return mat

def mat_to_string(mat):
    return ''.join(str(val) for row in mat for val in row)