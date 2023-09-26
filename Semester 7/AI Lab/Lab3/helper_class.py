import numpy as np

BLANK_KEY = -1
PUZZLE_NUM_ROWS = 3
PUZZLE_NUM_COLS = 3


class Matrix:
    def __init__(self, mat = []):
            self.mat = mat
            for i in range (0, PUZZLE_NUM_ROWS):
                for j in range(0, PUZZLE_NUM_COLS):
                    if mat[i, j] == BLANK_KEY:
                        self.blank = (i, j)
                        break
            if self.blank is None:
                raise ValueError(f"No blank found in given matrix {mat}")

class Curr_State_Info:

    def __init__(self, matrix_state: Matrix, g_n, h_n):
        self.state = matrix_state
        self.g_n = g_n
        self.h_n = h_n
        
    def __lt__(self, other):
        if self.h_n == other.h_n:
            return self.g_n < other.g_n
        return self.h_n < other.h_n

    def __le__(self, other):
        return self.h_n <= other.h_n
    

