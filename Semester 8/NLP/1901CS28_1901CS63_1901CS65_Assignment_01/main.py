from sklearn.model_selection import train_test_split
from helper import *
from tabulate import tabulate
from tqdm import tqdm
from viterbi import viterbi_model


def checkfor_metrics_accuracy(correct, total):   
    accuracy_split_classwise = {}
    
    accuracy = sum(x for x in correct.values()) / sum(x for x in total.values())
    print(f'\nHMM Model Accuracy = {accuracy}\n')

    for tag in sorted(total.keys()):
        accuracy_split_classwise[tag] = correct[tag] / total[tag]
    
    print('Class-wise Accuracies \n')
    print(tabulate(zip(accuracy_split_classwise.keys(), accuracy_split_classwise.values()),
                   headers=['Class (Tag)', 'Accuracy'],
                   tablefmt='orgtbl'))

def trial_and_check(x, y, transition, emission, complete_tags):
    print(f'Evaluating {len(x)} sentences.\n')
    
    true_predictions = defaultdict(lambda: 0)
    count_of_tags = defaultdict(lambda: 0)

    for sentence, actual_tag_sequence in tqdm(zip(x, y), total=len(x)):
        predicted_tag_sequence = viterbi_model(sentence, transition, emission, complete_tags)
        for predicted, actual in zip(predicted_tag_sequence, actual_tag_sequence):
            true_predictions[actual] += predicted == actual
            count_of_tags[actual] += 1

    checkfor_metrics_accuracy(true_predictions, count_of_tags)   

def main():
    data_x, data_y = load_dataset()
    x_train, x_test, y_train, y_test = train_test_split(data_x, data_y, test_size=0.2)

    # For all the tags
    print('-' * 80)
    print('HMM for 36 tags : ')
    complete_tags = ['*'] + list(set(tag for tag_list in y_train for tag in tag_list)) + ['STOP']
    emission_matrix = produce_emission_matrix(x_train, y_train)
    transition_matrix = produce_transition_matrix(y_train)

    trial_and_check(x_test, y_test, transition_matrix, emission_matrix, complete_tags)

    # Collapsing into 4 tags and repeating
    print('-' * 80)
    print('Number of tags reduced to 4. HMM for 4 tags :')
    y_train, y_test = collapse_to_4_tags(y_train, y_test)

    complete_tags = ['*'] + list(set(tag for tag_list in y_train for tag in tag_list)) + ['STOP']
    emission_matrix = produce_emission_matrix(x_train, y_train)
    transition_matrix = produce_transition_matrix(y_train)

    trial_and_check(x_test, y_test, transition_matrix, emission_matrix, complete_tags)
    print('-' * 80)

if __name__ == "__main__":
    main()
