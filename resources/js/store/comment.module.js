const state = {
    comments: [],
};

const getters = {
    getComments: state => state.comments,
};

const actions = {
    getComments({commit,getters}) {
        return new Promise(resolve => {
            axios.get('/api/comments')
                .then(({data}) => {
                    commit('setComments', data)
                    resolve(data);
                })
        });

    },
    saveComments({}, payload) {
        return new Promise(resolve => {
            axios.post('/api/comments/add', payload)
                .then(({data}) => {
                    resolve(data);
                })
        });
    },
};

const mutations = {
    setComments(state, response) {
        state.comments = response;
    }
};

export default {
    state,
    actions,
    mutations,
    getters
};
