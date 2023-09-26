from queue import Queue

# Depth of optimum path in DFS
dfs_depth = 0
total_dfs_iteration = 0

#Depth of optimum path in BFS
bfs_depth = 0
total_bfs_iteration = 0

def state_input(input_prompt) :
    print(f'Enter {input_prompt} : ')
    input_matrix = []					# Stores input matrix
    def convert_to_int(x) : 			# converts the string input into int
        try : 
            return int(x)
        except(ValueError,TypeError)  :
            return 0
            
    for i in range(3) : 				# Takes the matrix input as list of list
        input_matrix.append(list(map(convert_to_int,input().split())))
    
    return get_hash(input_matrix)		# find the hash of matrix

# Converts a given hash into matrix
def get_grid(matrix_string_hash) :
    string_matrix_unhash = []
    for i in range(3) : 
        string_matrix_unhash.append([])
        for j in range(3) : 
            string_matrix_unhash[-1].append(matrix_string_hash % 10)
            matrix_string_hash //= 10
        string_matrix_unhash[-1].reverse()
    string_matrix_unhash.reverse()
    return string_matrix_unhash

# Direction matrix 
dx = [1,-1,0,0]
dy = [0,0,-1,1]

# Checks bounds in the matrix while moving the blank space
def check_bounds(x,y) : 
    return x >= 0 and y >= 0 and x <= 2 and y <= 2

# get the position of blank tile in the matrix
def get_blank_indexes(matrix_state) : 
    for i in range(3) : 
        for j in range(3) : 
            if matrix_state[i][j] == 0 : 
                return (i,j)
                
# Gets hash of the matrix
def get_hash(matrix_state) : 
    # print(matrix_state)
    matrix_string_hash = 0
    for i in range(3):
        for j in range(3):
            matrix_string_hash *= 10
            matrix_string_hash += matrix_state[i][j]
    
    return matrix_string_hash

# BFS into the matrix
def bfs(current_state,target_state_hash):
	global bfs_depth
	global total_bfs_iteration
	
	# Queue for iterative bfs
	q = Queue(maxsize = 0)
	
	# Set to store hash value of visited states
	visited_state = {current_state}
	q.put((current_state,0)) # stores current state, no. of steps required to reach there
	while q.empty() == False:
		current_state_hash, current_bfs_count = q.get()
		visited_state.add(current_state_hash)
		
		# If reached the final state
		if current_state_hash == target_state_hash :
			bfs_depth = current_bfs_count
			return True
			
		# Convert the given hash string into matrix
		current_state_matrix = get_grid(current_state_hash)
		
		# get the position of blank tile
		i,j = get_blank_indexes(current_state_matrix)
		
		for k in range(4) :
			nxti = i +  dx[k]
			nxtj = j + dy[k]
			
			# if the next state is valid, travese
			if check_bounds(nxti,nxtj) :
				current_state_matrix[i][j], current_state_matrix[nxti][nxtj] = current_state_matrix[nxti][nxtj], current_state_matrix[i][j]
				new_state_hash = get_hash(current_state_matrix)
				current_state_matrix[i][j], current_state_matrix[nxti][nxtj] = current_state_matrix[nxti][nxtj], current_state_matrix[i][j]
				
				# If not state not reached already
				if new_state_hash not in visited_state :
					total_bfs_iteration = total_bfs_iteration + 1
					q.put((new_state_hash,current_bfs_count + 1))
	
	# If we reach here then the state is not reachable
	print("State Not Reachable via Bfs")
	return False

# DFS into the matrix
def dfs(current_state,target_state_hash) : 
    global dfs_depth
    global total_dfs_iteration
    
    # Stack for iterative dfs
    stack = []
    stack.append((current_state,0))	# Stores current ctate and number of step s required to reacch there
    
    # Set to store hash value of visited states
    visited_state = set()
    
    while(len(stack)):
    	current_state_hash = stack[-1][0]
    	current_dfs_count = stack[-1][1]
    	
    	print(current_state_hash,current_dfs_count)	# debug 
    	stack.pop()
    	visited_state.add(current_state_hash)
    	
    	# If reached the final state
    	if current_state_hash == target_state_hash :
    		dfs_depth = current_dfs_count
    		return True
    	
    	# Convert the given hash string into matrix
    	current_state_matrix = get_grid(current_state_hash)
    	
    	# get the position of blank tile
    	i,j = get_blank_indexes(current_state_matrix)
    	for k in range(4) :
	        nxti = i +  dx[k]
	        nxtj = j + dy[k]
			
			# if the next state is valid, travese
	        if check_bounds(nxti,nxtj) : 
	            current_state_matrix[i][j], current_state_matrix[nxti][nxtj] = current_state_matrix[nxti][nxtj], current_state_matrix[i][j]
	            new_state_hash = get_hash(current_state_matrix)
	            current_state_matrix[i][j], current_state_matrix[nxti][nxtj] = current_state_matrix[nxti][nxtj], current_state_matrix[i][j]
	            # if not state not reached already
	            if new_state_hash not in visited_state :
	            	total_dfs_iteration = total_dfs_iteration + 1
	            	stack.append((new_state_hash,current_dfs_count + 1))
   
    # if we reach here then the state is not reachable
    print("State Not Reachable via dfs")
    return False

# DFS & BFS
def solve(start_state_hash,target_state_hash) : 
    # Depth of best path
    global dfs_depth
    global bfs_depth
    # Total number of iteration
    global total_dfs_iteration
    global total_bfs_iteration
       
    # Do DFS
    dfs(start_state_hash,target_state_hash)
    print(f'DFS Depth : {dfs_depth}')
    print(f'Total DFS iterations : {total_dfs_iteration}')
    
    # DO BFS
    bfs(start_state_hash,target_state_hash)
    print(f'BFS Depth : {bfs_depth}')
    print(f'Total BFS iterations : {total_bfs_iteration}')

# Main function
def main():
	start_state = state_input("Start grid")
	target_state = state_input("Target grid")
	solve(start_state,target_state)
	
# Driver code
if __name__ == '__main__':
	main()