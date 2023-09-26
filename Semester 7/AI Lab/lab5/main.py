#!/usr/bin/env python
import random
import math
import time
MUTATION_CHANCE = 0.1
CROSS_OVER_RATE = 0.8
POPULATION_LEN = 10
MAX_ITERATION = 2000

# All the genes avavailable for a chromose to take
dataset = ['5','9','8','4','2','1','7','3','6','B','D','E','A','F','C','G','H']

# Initial Parents
p1 = ['5','9','8','4','2','1','7','3','6']
p2 = ['B','D','E','A','F','C','G','H','_']

# Goal State
goal = ['1','2','3','4','5','6','7','8','B']

#Optimal generation path
parent = {}

# Fitness Function
# Fitness function 1
def find_fitness1(population):
	length = len(population)
	fitness = []
	for i in range(length):
		score = 0
		for j in range(9):
			if population[i][j] == goal[j]:
				score += 20
			elif population[i][j] in goal:
				score += 10
			elif population[i][j] == '_':
				score -= 300
			else:
				score -= 30
		for j in range(9):
			if population[i].count(population[i][j])>1:
				score -= 10
		fitness.append([score,i])
	return fitness

# Fitness function 2
def find_fitness2(population):
	length = len(population)
	fitness = []
	for i in range(length):
		score = 0
		for j in range(9):
			if population[i][j] == goal[j]:
				score += 20
			elif population[i][j] in goal:
				score += 10
			elif population[i][j] == '_':
				score -= 300
		fitness.append([score,i])
	return fitness

# Select parents using roulette wheel techinique
def select_parent(fitness,total_fitness_score):
	length = min(2,POPULATION_LEN)

	p1_roulette = random.random() * total_fitness_score
	p1_index = 0
	curr = 0
	for i in range(length):
		curr += fitness[i][0]
		if i == (length-1):
			p1_index = i
			break
		elif curr < p1_roulette and curr + fitness[i+1][0] >= p1_roulette:
			p1_index = i
			break
	p2_roulette = random.random() * total_fitness_score
	p2_index = 0
	curr = 0
	for i in range(length):
		curr += fitness[i][0]
		if i == (length-1):
			p2_index = i
			break
		elif curr < p2_roulette and curr + fitness[i+1][0] >= p2_roulette:
			p2_index = i
			break
	if p1_index == p2_index:
		if p1_index + 1< length:
			p1_index += 1
		else:
			p1_index -= 1
	return p1_index,p2_index

# Crossover between teo chromoomes
def cross_over(a, b):
		# Producing n(number of genes) offspring using random point crosover
        children = []
        length = len(a)
        cross_over_occur = math.ceil(length * CROSS_OVER_RATE)
        for j in range(length):
        	curr_child = []
	        for i in range(length):
	            if random.random() < 0.5:
	                curr_child.append(a[i])
	            else:
	                curr_child.append(b[i])
	        children.append(curr_child)

        return children

# Mutation 
def mutate(population):
	# length of current population
    length = len(population)
    for j in range(length):
	        for i in range(length):
	        	# Mutate a gene if the probability is favored
	            if random.random() < MUTATION_CHANCE:
	                population[j][i] = random.choice(dataset)

if __name__ == "__main__":
	
	# Iteration count
	cnt = 0
	
	#Number of states explored
	numOfStates = 0
		
	# List to maintain population
	population = []
	population.append(p1)
	population.append(p2)
	
	# Initial Parents (PS: Adam and Eve)
	parent1 = p1
	parent2 = p2
	
	# A list of parents who will reproduce new offsprings
	parents_list = [[p1,p2]]
	
	# New Generation
	new_population = []
	start_time = time.time()
	# Loop until a fixed number of generation
	while cnt < MAX_ITERATION:
		# Find the fitness of population
		fitness = find_fitness1(population)
		fitness.sort(reverse = True)
		new_population.clear()
		
		if cnt != 0:			
			offspring_size = 0
			ind = 0
			while ind<len(population) and offspring_size < POPULATION_LEN:
				offspring_size +=1
				new_population.append(population[fitness[ind][1]])
				ind+=1
				
		population.clear()	
		numOfStates += len(new_population)
		
		for i in range(len(new_population)):
			if new_population[i] == goal:
				end_time = time.time()
				print("Solution found")
				print("Start state:")
				print("Adam: ",p1)
				print("Eve: ",p2)
				print("End State: ", goal)
				print("Number of States explored: %d" %numOfStates)
				print("Number of steps required: %d" %cnt)
				print(f"Time taken: {end_time - start_time}")
				exit()
			
		# Roulette wheel params
		# Adjusting negative fitness score to calculate probability	
		total_fitness_score = 0
		min_fitness = fitness[0][0]
		for i in range(len(new_population)):
			min_fitness = min(fitness[i][0],min_fitness)
		for i in range(len(new_population)):
			fitness[i][0] -= min_fitness
			total_fitness_score += fitness[i][0]
				
		if cnt != 0:
			parents_list = []
			for i in range(math.ceil(len(new_population)/2)):
				p1_index, p2_index = select_parent(fitness,total_fitness_score)
				parent1 = new_population[p1_index]
				parent2 = new_population[p2_index]
				parents_list.append([parent1,parent2])
		# print(cnt,parent1,parent2)
		
		for i in range(len(parents_list)):
			offspring = cross_over(parents_list[i][0],parents_list[i][1])
			mutate(offspring)
			population = population + offspring
		# print(population)
		cnt+=1
		
	print("No Solution found in %d generations." %MAX_ITERATION)
	print("Start state:")
	print("Adam: ",p1)
	print("Eve: ",p2)
	print("End State: ", goal)
	print("Number of States explored: %d" %numOfStates)
	end_time = time.time()
	print(f"Time taken: {end_time - start_time}")
	