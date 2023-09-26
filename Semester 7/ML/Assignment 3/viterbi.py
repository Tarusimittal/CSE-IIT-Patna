from collections import defaultdict


def kappa(position, all_tags):
    return all_tags if position not in [0, -1] else ['*']

def viterbi_trigram(sentence, transition, emission, all_tags, with_context=False):
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
                    if with_context:
                        emission_tuple = (sentence[k - 1], v, u)
                    else:
                        emission_tuple = (sentence[k - 1], v)
                    reach_prob = pi[(k - 1, w, u)] * transition[(w, u, v)] * emission[emission_tuple]
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
    
    if n == 0:
        return []
    
    elif n == 1:
        return [result_tags[0]]
    
    for k in range(n - 2, 0, -1):
        result_tags.append(bp[(k + 2, result_tags[-1], result_tags[-2])])
    
    result_tags.reverse()

    return result_tags

def viterbi_bigram(sentence, transition, emission, all_tags, with_context=False):
    pi = defaultdict(lambda: 0)
    bp = defaultdict(lambda: "OTH")
    pi[(0, '*')] = 1.0

    n = len(sentence)

    for k in range(1, n + 1):
        u_set = kappa(k - 1, all_tags)
        v_set = kappa(k, all_tags)

        for v in v_set:
            for u in u_set:
                if with_context:
                    emission_tuple = (sentence[k - 1], v, u)
                else:
                    emission_tuple = (sentence[k - 1], v)
                reach_prob = pi[(k - 1, u)] * transition[(u, v)] * emission[emission_tuple]
                if reach_prob > pi[(k, v)]:
                    pi[(k, v)] = reach_prob
                    bp[(k, v)] = u
    
    v_set = kappa(n, all_tags)
    result_tags = []
    for v in v_set:
        if len(result_tags) == 0:
            result_tags = [v]
        if pi[(n, v)] * transition[(v, 'STOP')] > \
        pi[(n, result_tags[0])] * transition[result_tags[0], 'STOP']:
            result_tags = [v]
        
    if n == 0:
        return []
    
    for k in range(n - 1, 0, -1):
        result_tags.append(bp[(k + 1, result_tags[-1])])
    
    result_tags.reverse()

    return result_tags

def viterbi(sentence, transition, emission, all_tags, ngram=2, with_context=False):
    if ngram == 3:
        return viterbi_trigram(sentence, transition, emission, all_tags, with_context)
    return viterbi_bigram(sentence, transition, emission, all_tags, with_context)