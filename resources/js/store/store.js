import axios from "axios";
import Vue from "vue";
import Vuex from "vuex";
import comments from "./comment.module";

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {},
    getters: {},
    mutations: {},
    actions: {},
    modules: {
        comments
    }

});
