// STATE
const state = {
    variable1: 'I am from a central store!',
    ongoing_pending_count: null,
    advanced_orders_count: null,
}

// Getter functions
const getters = {
    getOngoingPendingCount( state ) {
       return state.ongoing_pending_count;
    },
    getAdvancedOrdersCount( state ) {
       return state.advanced_orders_count;
    },
}

// ACTIONS
const actions = {
    // kaloy 2021-10-22
    ongoingPendingCount({commit, rootState}) {
        axios.get(`${rootState.siteUrl}transaction/get-ongoing-transactions-count`)
        .then(response => {
            commit('setOngoingPendingCount', response.data)
        })
        .catch(err => {
            console.log('ERR @ ongoingPendingCount(): ', err);
        })
    },

    advancedOrdersCount({commit, rootState}) {
        axios.get(`${rootState.siteUrl}transaction/advanced-orders-count`)
        .then(response => {
            commit('setAdvancedOrdersCount', response.data)
        })
        .catch(err => {
            console.log('ERR @ advancedOrdersCount(): ', err);
        })
    },
}

// MUTATIONS
const mutations = {
    setOngoingPendingCount(state, data) {
       state.ongoing_pending_count = data;
    },
    setAdvancedOrdersCount(state, data) {
       state.advanced_orders_count = data;
    },
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}