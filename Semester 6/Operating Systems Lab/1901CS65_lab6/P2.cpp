#include <bits/stdc++.h>
using namespace std;

// A class of a single processes
class Process {
public:
	int pid;	// Process ID
	int wt;		// Waiting Time
	int tat;	// Turn Around Time
	int arrivalTime;	// Arrival Time
	int burstTime;		// Burst Time
	int remainingTime;     //amount of CPU time remaining after each execution
	int finishTime;		// Finish Time
	bool isFinish;		//to check if it is finished or not
	bool inQueue;		// to check if it is entered in teh queue or not
};

bool compareFinish(Process p1, Process p2);
bool compareArrival(Process p1, Process p2);
void roundRobin(vector<Process> &processes, int quantum);
void printingAvg(vector<Process> &processes);
void enterNew(vector<Process> &processes, int time, queue<int> &mQueue);
void enterInQueue(vector<Process> &processes, int quantum, queue<int> &mQueue, int &time, int &processComplete );

int main(){
	
	cout<<"Write the no of processes(n): ";
	int n;  //no of processes
	cin >> n;						
	cout<<"Enter the time quantum: ";
	int quantum;
	cin>>quantum;
	
	vector<Process> processes(n); //vector to store the data of processes
	
	for (int i = 0; i < n; i++){
		processes[i].pid = i + 1;
		cin >> processes[i].arrivalTime >> processes[i].burstTime;
		processes[i].remainingTime = processes[i].burstTime;
	}

	// To find the waiting time and turn around time for all the proceeses
	roundRobin(processes,quantum);
	
	// To print the waiting time and turn around time for all the proceeses
	printingAvg(processes);
}

// To sort according to the finish times 
bool compareFinish(Process p1, Process p2){
	return p1.finishTime < p2.finishTime;
}

// To sort according to the arrival times 
bool compareArrival(Process p1, Process p2){
	if (p1.arrivalTime == p2.arrivalTime){
		return p1.pid < p2.pid;
	} 
	else{
		return p1.arrivalTime < p2.arrivalTime;
	}
}

//This function take sinto consideration every new addition
// Amd push iyt in the queue accordingly
void enterNew(vector<Process> &processes, int time, queue<int> &mQueue){
	int n = processes.size();
	for(int i=0;i<n;i++){
		if(processes[i].arrivalTime <= time && !processes[i].inQueue && !processes[i].isFinish){
			processes[i].inQueue = true;
			mQueue.push(i);
		}
	}
}

//This checks the process at every teration
void enterInQueue(vector<Process> &processes, int quantum, queue<int> &mQueue, int &time, int &processComplete ){
	int i = mQueue.front();
	mQueue.pop();
	int n = processes.size();
	
	//If we know that teh process will be complete now
	//So we will upadet pur queue and remove this process
	//And upadet its finish time and wt and tat
	if(processes[i].remainingTime <= quantum){
		processes[i].isFinish = true;
		time += processes[i].remainingTime;
		processes[i].finishTime = time;
		processes[i].wt = processes[i].finishTime - processes[i].arrivalTime - processes[i].burstTime;
		processes[i].tat = processes[i].wt + processes[i].burstTime;
		
		if(processes[i].wt<0){
			processes[i].wt = 0;
		}
		processes[i].remainingTime = 0;
		
		if(processComplete != n){
			enterNew(processes, time, mQueue);
		}
	}
	
	//if teh process is not completed
	// we will minus the time quanm 
	// amd push it in the back of queue
	else{
		processes[i].remainingTime -= quantum;
		time += quantum;
		if(processComplete != n){
			enterNew(processes, time, mQueue);
		}
		mQueue.push(i);
	}
}

// First Come First Serve Algorithm
void roundRobin(vector<Process> &processes, int quantum){
	int n = processes.size();
	int time = 0;
	int processComplete = 0; //counter of how many progarm are completed;
	
	//We first sort the vector according to their arrival times
	sort(processes.begin(), processes.end(), compareArrival);
	
	queue <int> mainQueue;
	mainQueue.push(0);
	processes[0].inQueue = true;
	
	//for every new process we will update the queue
	//SO that we can keep a check on when any process is entering the cpu
	while(!mainQueue.empty()){
		enterInQueue(processes, quantum, mainQueue, time, processComplete);
	}
	
	return;
}

/* Print average WT and average TAT */
void printingAvg(vector<Process> &processes){
	double waitingTimeAvg = 0.0;
	double turnAroundAvg = 0.0;
	int n = processes.size();

	//we add all the avg wt and tat
	//so that we can find teh avg by diving by n
	for(auto p: processes){
		waitingTimeAvg = waitingTimeAvg + p.wt;
		turnAroundAvg = turnAroundAvg + p.tat;
	}

	//because we want 2decimal places
    cout << fixed << setprecision(2);
	waitingTimeAvg /= n;
	turnAroundAvg /= n;
	cout << waitingTimeAvg << " " << turnAroundAvg << endl;

	//We first sort the vector according to their finish times
	sort(processes.begin(), processes.end(), compareFinish);

	for (int i = 0; i < n; i++){
		cout << "P" << processes[i].pid << " ";
	}
	cout << endl;

	return;
}