import axios from "axios";

export default {
    namespaced: true,
    state: {
        token: null,
        user: null
    },
    getters: {
        authenticated(state) {
            return state.token && state.user;
        },
        user(state) {
            return state.user;
        }
    },
    mutations: {
        SET_TOKEN(state, token) {
            state.token = token;
        },
        SET_USER(state, data) {
            state.user = data;
        }
    },
    actions: {
        async signIn({ dispatch }, credentials) {
            let response = await axios.post("api/auth/signin", credentials);
            return dispatch("attempt", response.data.token);
        },

        async attempt({ commit, state }, token) {
            // console.log(token);
            if (token) {
                commit("SET_TOKEN", token);
            }
            if (!state.token) {
                return;
            }
            try {
                let response = await axios.get("api/auth/me");
                commit("SET_USER", response.data);
            } catch (e) {
                commit("SET_TOKEN", null);
                commit("SET_USER", null);
                // console.log("failed");
            }
        },
        signOut({ commit }) {
            return axios.post("api/auth/signout").then(() => {
                commit("SET_TOKEN", null);
                commit("SET_USER", null);
            });
        }
    }
};