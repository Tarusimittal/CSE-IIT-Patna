#include <bits/stdc++.h>
#include <fstream>
using namespace std;
//FILE *gnuplotPipe;
int TotHeadMov[4], TotSeekMov[4];

string algorithm[] = {"FCFS", "SCAN", "CSCAN", "SSTF"};

// Struct defining the order and disk requested
typedef struct Request{
	int idx;
	int req;
} Request;

// Comparator for Q-Sort according to disk requested
int compare (const void * a, const void * b) {
	Request A = *((Request*)a);
	Request B = *((Request*)b);
	return ( A.req - B.req );
}

// Comparator for Q-Sort according to index number
int compare_idx (const void * a, const void * b) {
	Request A = *((Request*)a);
	Request B = *((Request*)b);
	return ( A.idx - B.idx );
}


// FCFS Disk Scheduling
void fcfs(int cylinders, int headPosition, int noOfRequests, Request disk[]) {
	int HeadMove[noOfRequests];
	ofstream fout;
	fout.open("fcfs.txt");
	fout<<0<<" "<<100<<endl;

	for (int i = 0; i < noOfRequests; i++) {
		HeadMove[i] = abs(headPosition - disk[i].req);
		headPosition = disk[i].req;
		TotHeadMov[0] += HeadMove[i];
		fout<<disk[i].idx+1<<" "<<disk[i].req<<endl;
	}
	fout.close();

	TotSeekMov[0]=TotHeadMov[0]*5;
	cout<<endl<<algorithm[0]<<" Disk Scheduling\nTotal Head Movement = "<<TotHeadMov[0]<<"\nTotal Seek Time = "<<TotSeekMov[0]<<" ms"<<endl;

	return;
}

// SCAN Disk Scheduling
void scan(int cylinders, int headPosition, int noOfRequests, Request disk[]) {
	int start = -1;
	int cnt=1;
	int idx;
	int HeadMove[noOfRequests];
	ofstream fout;
	fout.open("scan.txt");
	fout<<0<<" "<<100<<endl;

	qsort(disk, noOfRequests, sizeof(Request), compare);

	// Forward movement from the current position
	for (int i = 0; i < noOfRequests; i++) {
		if (disk[i].req >= headPosition) {
			if (start == -1) start = i;
			idx = disk[i].idx;
			HeadMove[idx] = disk[i].req - headPosition;
			fout<<cnt++<<" "<<disk[i].req<<endl;
			headPosition = disk[i].req;

		}
	}
	fout<<cnt++<<" "<<cylinders-1<<endl;
	TotHeadMov[1] += cylinders-1-headPosition;
	headPosition = cylinders - 1;
	// Reverse movement from end
	for (int i = start - 1; i >= 0; i--) {
		if (disk[i].req <= headPosition) {
			idx = disk[i].idx;
			HeadMove[idx] = headPosition - disk[i].req;
			fout<<cnt++<<" "<<disk[i].req<<endl;
			headPosition = disk[i].req;
		}
	}
  fout.close();
	qsort(disk, noOfRequests, sizeof(Request), compare_idx);

	for(int i=0;i<noOfRequests; i++){
		TotHeadMov[1] += HeadMove[i];
	}
	TotSeekMov[1]=TotHeadMov[1]*5;
	cout<<endl<<algorithm[1]<<" Disk Scheduling\nTotal Head Movement = "<<TotHeadMov[1]<<"\nTotal Seek Time = "<<TotSeekMov[1]<<" ms"<<endl;

}

// CSCAN Disk Scheduling
void cscan(int cylinders, int headPosition, int noOfRequests, Request disk[]) {
	int start = -1, idx;
	int cnt=1;
	int HeadMove[noOfRequests];
	ofstream fout;
	fout.open("cscan.txt");
	fout<<0<<" "<<100<<endl;

	qsort(disk, noOfRequests, sizeof(Request), compare);

	// Forward movement from the current position
	for (int i = 0; i < noOfRequests; i++) {
		if (disk[i].req >= headPosition) {
			if (start == -1) start = i;
			idx = disk[i].idx;
			HeadMove[idx] = disk[i].req - headPosition;
			fout<<cnt++<<" "<<disk[i].req<<endl;
			headPosition = disk[i].req;
		}
	}
	TotHeadMov[2] += 199-headPosition;
 fout<<cnt++<<" "<<cylinders-1<<endl;
 fout<<cnt++<<" "<<"0"<<endl;
	// Return to beginning and then forward movement from beginning
	headPosition = 0;
	for (int i = 0; i < start; i++) {
		if (disk[i].req >= headPosition) {
			idx = disk[i].idx;
			HeadMove[idx] = disk[i].req - headPosition;
			fout<<cnt++<<" "<<disk[i].req<<endl;
			headPosition = disk[i].req;
		}
	}
	fout.close();
	qsort(disk, noOfRequests, sizeof(Request), compare_idx);

	for(int i=0;i<noOfRequests; i++){
		TotHeadMov[2] += HeadMove[i];
	}
	TotHeadMov[2]+=199;
	TotSeekMov[2]=TotHeadMov[2]*5;
	cout<<endl<<algorithm[2]<<" Disk Scheduling\nTotal Head Movement = "<<TotHeadMov[2]<<"\nTotal Seek Time = "<<TotSeekMov[2]<<" ms"<<endl;

}

// SSTF Disk Scheduling
void sstf(int cylinders, int headPosition, int noOfRequests, Request disk[]) {
	int serviced = 0;
	int HeadMove[noOfRequests];
	ofstream fout;
	fout.open("sstf.txt");
	fout<<0<<" "<<100<<endl;

	while (serviced < noOfRequests) {
		int min_idx = -1;
		for (int i = 0; i < noOfRequests; i++) {
			if ( min_idx == -1 || abs(disk[i].req - headPosition) < abs(disk[min_idx].req - headPosition) )
				min_idx = i;
		}
		int idx = disk[min_idx].idx;
		HeadMove[idx] = abs(disk[min_idx].req - headPosition);
		fout<<disk[min_idx].idx+1<<" "<<disk[min_idx].req<<endl;
		headPosition = disk[min_idx].req;
		disk[min_idx].req = INT_MAX;
		serviced++;
	}
	fout.close();

	for(int i=0;i<noOfRequests; i++){
		TotHeadMov[3] += HeadMove[i];
	}
	TotSeekMov[3]=TotHeadMov[3]*5;
	cout<<endl<<algorithm[3]<<" Disk Scheduling\nTotal Head Movement = "<<TotHeadMov[3]<<"\nTotal Seek Time = "<<TotSeekMov[3]<<" ms"<<endl;

}

int main() {
	int cylinders, headPosition, noOfRequests;

	cout<<"Enter The No of Cylinders: ";
	cin>>cylinders;

	cout<<"Enter the head position: ";
	cin>>headPosition;

	cout<<"Enter the number of disk requests: ";
	cin>>noOfRequests;

	Request disk[noOfRequests];
	cout<<"Enter the requests separated with space: ";
	for (int i = 0; i < noOfRequests; i++) {
		cin>>disk[i].req;
		disk[i].idx = i;
	}


	fcfs(cylinders, headPosition, noOfRequests, disk);
	scan(cylinders, headPosition, noOfRequests, disk);
	cscan(cylinders, headPosition, noOfRequests, disk);
	sstf(cylinders, headPosition, noOfRequests, disk);

	//to print the sorted order
	//based on the performance of algorithms
	int count = 0;
	cout<<endl<<"Sorted order of algorithms:"<<endl;
	while (count < 4) {
		int min_idx = 0;
		for (int i = 0; i < 4; i++) {
			if ( TotHeadMov[i] < TotHeadMov[min_idx] ) min_idx = i;
		}
		cout<<algorithm[min_idx]<<" ";
		TotHeadMov[min_idx] = INT_MAX;
		count++;
	}
	printf("\n");

}