#include <bits/stdc++.h>
using namespace std;

//Assumption: Maximum process can be 200 only
int process,resources;

int available[200];			  // Total of Available resources
int allocated[200][200];	// Allocated resources to the processes
int maxi[200][200];			  // Maximum resources required by the processes
int require[200][200];		// Remaining number of resources required
int safe[200];				    // To store a safe sequence
bool Completed[200];		  // To store if processes are completed or not
int total = 0;				    // Total no of safe sequences
int current_size;				  // Size of a building safe sequence

//All the functions used in the program
void safeSequence();
bool if_available(int cuurent_index);
void subtract_resources(int cuurent_index);
void add_resources(int cuurent_index);
void printSequence();

int main(){

	cout<<"Enter the no of process: ";
	cin>>process;
	cout<<"Enter the no of resources: ";
	cin>>resources;

	cout<<"Enter the available resources with spaces: "<<endl;
	for (int i = 0; i < resources; i++){
		cin>>available[i];
	}

	cout<<"Enter the allocation matrix in process*resources order:"<<endl;
	for (int i = 0; i < process; i++){
		for (int j = 0; j < resources; j++){
			cin>>allocated[i][j];
		}
	}

	cout<<"Enter the maximum matrix in process*resources order: "<<endl;
	for (int i = 0; i < process; i++){
		for (int j = 0; j < resources; j++){
			cin>>maxi[i][j];
		}
	}

  memset(Completed, false, sizeof(Completed)); //at start the initial matrix is all false

	// Finding require matrix
	// require[i][j] = maxi[i][j] - allocated[i][j];
	for (int i = 0; i < process; i++){
		for (int j = 0; j < resources; j++){
			require[i][j] = maxi[i][j] - allocated[i][j];
		}
	}

	// Find safe sequences
	safeSequence();

	// If totalis 0 it means that no safe sequence is there
	if (total == 0){
		cout<<endl<<"There are no safe-sequences!"<<endl;
	}

	return 0;
}

// Find and print all the safe-sequences using Banker's Algorithm
void safeSequence(){
	//If we find a safe sequence we print it
	if (current_size == process){
		 printSequence();
		 return;
	}

	for (int i = 0; i < process; i++){
		if (Completed[i] == false && if_available(i)){
			//if resource available and process not complete
			//then we complete teh processes
			//and modify our add rezources
			Completed[i] = true;

			//goes to the add resources to safely add resources to teh avilable resources
			add_resources(i);

			// Find the safe sequence that are remaining
			safe[current_size++] = i;
			safeSequence();

			current_size--;
			Completed[i] = false;

			// if we allocate resources
			subtract_resources(i);

		}
	}

}

// To print the sequence
void printSequence(){
	total++;
	cout<<"Safe sequence "<<total<<": ";
	for (int i = 0; i < process; i++) {
		cout<<safe[i];
		if (i != (process - 1))
			cout<<" -> ";
	}
	cout<<endl;
}

// Function to add resources from allocated[current_index] to available
void add_resources(int cuurent_index){
	for (int i = 0; i < resources; i++) {
		available[i] += allocated[cuurent_index][i];
	}
	return;
}

// Function to subtract resources from allocated[current_index] to available
void subtract_resources(int cuurent_index){
	for (int i = 0; i < resources; i++) {
		available[i] -= allocated[cuurent_index][i];
	}
	return;
}

// It checks that is the prcess available to be allocated or not
bool if_available(int cuurent_index){
	bool flag = true;
	// If all the available resources are greater than the
	// required no of resources by the processes
	//then that process can be completed
	for (int i = 0; i < resources; i++){
		if (require[cuurent_index][i] > available[i])
			flag = false;
	}
	return flag;
}


