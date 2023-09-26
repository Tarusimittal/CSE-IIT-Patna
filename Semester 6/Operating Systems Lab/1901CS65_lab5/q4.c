#include <stdio.h>
#include <pthread.h>
#include <unistd.h>

int m;   	  //The number of vending machines on the petrol pump
int capacity; //Total capacity of petrol in the tank at the petrol pump 

//Assuming that the count of vending machine will not exceed 15 
//And the number of customers in queue will not excedd 100
//This array stores the data of teh customers
int data_cust[15][100]; 

pthread_mutex_t newMutex;

//The actual function to control when which vending machine releases petrol
void *petrol_release(void *number);

int main(){
	
	//This part allows us to take input from a input file rather than from the command line
	//The file mentioned here will be used as the input file
    //If we want to change the file we can simply change the name over here
    #ifndef ONLINE_JUDGE                    
		freopen("example2.in","r",stdin); 
    #endif
    
	scanf("%d",&m);
	
	scanf("%d",&capacity);
	
	//taking input for each individual queue in front of the mth vending machine
	//And the petrol the jth person in the ith row wants to get filled 
	for(int i=0;i<m;i++){
		int persons;
		scanf("%d",&persons);
		for(int j=0;j<persons;j++){
			scanf("%d",&data_cust[i][j]);
		}
	}
	
	//create m no of threads for each vending machine
	pthread_t threads[m];
	pthread_mutex_init(&newMutex,0);
	
	//to store the index of the thread
	int num[m];
	for(int i=0;i<m;i++){
		 num[i]=i;
		 pthread_create(&threads[i], 0, petrol_release, (void*)&num[i]);
	}
	
	//joins the thread back to the main thread
	for(int i=0;i<m;i++){
		pthread_join(threads[i], 0);
	}
    pthread_mutex_destroy(&newMutex);
    pthread_exit(NULL);
    return 0;
}

void *petrol_release(void *number){
	//This function assures that no clashes takes place
	//It uses the concept od thread licking and unloacking
	//This method assures that if one thread in running and the other required same resources
	//It first will allot the resources to the first thread and the second thread will wait for it
		int machine_number = *(int*)number;
		int t_no=0;
		
		//Locks teh current thread for operation on it
		pthread_mutex_lock(&newMutex);
		
		//While the total capacity is not equal to 0
        while(capacity!=0){
			
			//If teh customer wants 0 petrol or teh no of customers gets finised we stop it
			//And free that thread
        	if(t_no==100 || data_cust[machine_number][t_no]==0){
        		pthread_mutex_unlock(&newMutex);
             	break;
        	}
        	
        	//If petrol is available for that much amount teh petrol is filled 
        	//And the total capaity is updated	
        	if(data_cust[machine_number][t_no]<=capacity){
        		printf("Capacity of Petrol in the Tank: %d\nMachine Number: %d, Required capacity Of Petrol: %d\nNew Capacity: %d\n", capacity, machine_number, data_cust[machine_number][t_no], capacity - data_cust[machine_number][t_no]);
        		capacity-=data_cust[machine_number][t_no];
        		t_no++;
        		}
        	else{
        		//Otherwise the sorry message is printed
        		printf("Capacity of Petrol in the Tank: %d\nMachine Number: %d, Required capacity Of Petrol: %d\nSorry Petrol Low!!\n", capacity, machine_number, data_cust[machine_number][t_no]);
        		t_no++;
        	}

			//The thread is unlocked and new threa gets locked
             pthread_mutex_unlock(&newMutex);
             sleep(1);
             pthread_mutex_lock(&newMutex);

        }
         pthread_mutex_unlock(&newMutex);
        pthread_exit(NULL);
}