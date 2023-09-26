from collections import defaultdict


def kappa(position, all_tags):
    return all_tags if position not in [0, -1] else ['*']

def viterbi_model(sentence, transition, emission, all_tags):
    sentence = sentence.split()
    pi = defaultdict(lambda: 0)
    bp = defaultdict(lambda: "OTH")
    pi[(0, '*', '*')] = 1.0

    n = len(sentence)

    for k in range(1, n + 1):
        u_set = kappa(k - 1, all_tags)
        v_set = kappa(k, all_tags)
        w_set = kappa(k - 2, all_tags)

        for v in v_set:
            for u in u_set:
                for w in w_set:
                    reach_prob = pi[(k - 1, w, u)] * transition[(w, u, v)] * emission[(sentence[k - 1], v)]
                    if reach_prob > pi[(k, u, v)]:
                        pi[(k, u, v)] = reach_prob
                        bp[(k, u, v)] = w
    
    u_set = kappa(n - 1, all_tags)
    v_set = kappa(n, all_tags)
    result_tags = []
    for u in u_set:
        for v in v_set:
            if len(result_tags) == 0:
                result_tags = [v, u]
            if pi[(n, u, v)] * transition[(u, v, 'STOP')] > \
            pi[(n, result_tags[1], result_tags[0])] * transition[result_tags[1], result_tags[0], 'STOP']:
                result_tags = [v, u]
    
    for k in range(n - 2, 0, -1):
        result_tags.append(bp[(k + 2, result_tags[-1], result_tags[-2])])
    
    result_tags.reverse()

    return result_tags
