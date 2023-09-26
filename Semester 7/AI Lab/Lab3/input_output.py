import numpy as np
from helper import string_to_mat, mat_to_string
from helper_class import Matrix

def readInput(input_path):
	mat = np.arange(3*3).reshape(3,3)
	with open(input_path) as f:
		row, col = (0, 0)
		for line in f:
			for i in range(0, len(line)):
				if line[i] == 'T':
					mat[row][col] = int(line[i + 1])
					col+=1
				if line[i] == 'B':
					mat[row][col] = -1
					col+=1
			row = row + 1
			col = 0
	return mat

def printMat(self):
    for i in range(0, 3):
        for j in range(0, 3):
            if self[i, j] == -1:
                print("B ", end='')
            else:
                print(f"T{self[i, j]} ", end='')
        print("")


def printOptimalPath(parent_list: dict, current_state: str, start_state: str):
	if current_state == start_state:
		printMat(string_to_mat(current_state))
		return
	printOptimalPath(parent_list, parent_list[current_state], start_state)
	print('\n   V		')
	print('				')
	printMat(string_to_mat(current_state))
	return

