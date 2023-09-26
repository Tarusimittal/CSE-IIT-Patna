#include <bits/stdc++.h>
using namespace std;

const int TimeQ[] = {4, 3};

// A class of a single process
class Process {
public:
	int pid;						// Process ID
	int at;							// Arrival Time
	int bt;							// Burst Time
	int ft;							// Finish Time
	int rt;						  // Remaining Time
	int priorityIndex;	// Priority
};

bool arrivalCompare(Process p1, Process p2);
bool finishCompare(Process p1, Process p2);
void updateTimeQueue(int &time, int new_time, int &queued, vector<Process> &process, vector<queue<Process*>> &ready);
int newQueue(vector<queue<Process*>> ready);
void multilevelSchedule(vector<Process> &process, int queues);

int main(){
	//Take input for no of process and queue
	int n, queues;
	cin >> n >> queues;

	//Makes a vector of processes
	vector<Process> process(n);
	for (int i = 0; i < n; i++){
		process[i].pid = i + 1;
		cin >> process[i].at >> process[i].bt >> process[i].priorityIndex;
		process[i].rt = process[i].bt;
	}

	//We find the finishing time of all the processes
	//Via the multilevel queue Scheduling algorithm
	multilevelSchedule(process, queues);

	//Now we define avf wt and average turn around tim to find and print them
	double avg_wt = 0.0;
	double avg_tat = 0.0;

	for (auto p: process){
		avg_wt = avg_wt + (p.ft - p.at) - p.bt; //Waiting time WT = TAT - BT
		avg_tat = avg_tat + p.ft - p.at;			//Turnaround time TAT = FT - AT
	}

	avg_wt = avg_wt/n;
	avg_tat = avg_tat/n;
	cout << fixed << setprecision(2); //To round upto 2 decimal places
	cout << "Avg_WT = " << avg_wt << " Avg_TAT = " << avg_tat << endl;

	//Sorting according to teh finish time so as to
	//Print the order in which the process are completed
	sort(process.begin(), process.end(), finishCompare);

	for (int i = 0; i < n; i++){
		cout << "P" << process[i].pid << " ";
	}
	cout << endl;
}


//To sort according to arrival times
bool arrivalCompare(Process p1, Process p2){
	if (p1.at == p2.at) return p1.pid < p2.pid;
	return p1.at < p2.at;
}

//To sort according to finish times
bool finishCompare(Process p1, Process p2){
	return p1.ft < p2.ft;
}

//Update teh finish and the remaining time
//Also when new process gets there
//Feed it in the ready queue accorging to the priority
void updateTimeQueue(int &time, int new_time, int &queued, vector<Process> &process, vector<queue<Process*>> &ready){
	time = new_time;
	int n= process.size();
	while (time >= process[queued].at && queued < n){
		ready[process[queued].priorityIndex - 1].push(&process[queued]);
		queued+=1;
	}
	return;
}

// Returns the minimum queue number which is non empty

int newQueue(vector<queue<Process*>> ready){
	int queues = ready.size();
	for (int i = 0; i < queues; i++){
		if (!ready[i].empty()){
			return i;
		}
	}
	return -1; //If all are queues are empty
}

//Multi Level Queue Scheduling Algorithm
void multilevelSchedule(vector<Process> &process, int queues){
	int n = process.size();
	int queued = 0;
	int time = 0;

	//Sort vector according to arrival times
	sort(process.begin(), process.end(), arrivalCompare);

	//The ready queue
	vector<queue<Process*>> ready(queues);

	while (true) {
		if (newQueue(ready) == -1){ // if all teh queues are empty
			if (queued == n){ // If all process arrive
				break;
			}
			//Updates the time and the ready queue to the closest arriving process
			updateTimeQueue(time, max(time, process[queued].at),queued, process, ready);
		}

		int top_ready = newQueue(ready); //next rocess in queue
		Process* p = ready[top_ready].front();
		ready[top_ready].pop();

		//Updates the finishing and the remaining time in this turn
		//p-> usd becaus eth etype is process *
		updateTimeQueue(time, time + min(TimeQ[min(top_ready, 1)], p->rt),queued, process, ready);
		p->rt = p->rt - min(TimeQ[min(top_ready, 1)], p->rt);

		if (p->rt == 0){
			 p->ft = time;
		}
		else ready[top_ready].push(p);
	}

	return;
}

/* Print average WT and average TAT */
void printAverage(vector<Process> &process) {
	int n = process.size();
	double avg_wt = 0.0;
	double avg_tat = 0.0;

	for (auto p: process) {
		avg_tat += p.ft - p.at;			// Add turnaround time TAT = FT - AT
		avg_wt += (p.ft - p.at) - p.bt; // Add waiting time WT = TAT - BT
	}

	avg_wt /= n;
	avg_tat /= n;
	cout << fixed << setprecision(2);
	cout << "Avg_WT = " << avg_wt << " Avg_TAT = " << avg_tat << endl;

	// Sort vector according to finish times
	sort(process.begin(), process.end(), finishCompare);

	for (int i = 0; i < n; i++) {
		cout << "P" << process[i].pid << " ";
	}
	cout << endl;

	return;
}
