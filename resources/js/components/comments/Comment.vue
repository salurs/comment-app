<template>
    <div>
        <h3>Share your ideas!</h3>
        <ul class="list-unstyled">
            <!--FIRST LIST ITEM-->
            <li v-for="item in getComments" :key="item.id">
               <div class="media">
                   <div class="d-flex justify-content-between align-items-center">
                    <span class="round pt-2">
                        <img src="https://img.icons8.com/bubbles/100/000000/male-user.png" class="align-self-start rounded-circle mr-3">
                        <span class="fw-bold">{{item.name}}</span>
                    </span>
                       <span class="time">{{moment(item.created_at).fromNow()}}</span>
                   </div>
                   <div class="media-body">
                       <p class="text">{{item.body}}</p>
                       <div>
                           <span @click="current_id = item.id" class="reply-btn">Reply</span>
                           <Add @clearCurrentId="clearCurrentId" :parent_id="current_id" v-if="item.id == current_id"/>
                       </div>
                   </div>
               </div>

                <div v-if="item.all_children.length">
                    <div v-for="child in item.all_children" :key="child.id" class="reply">
                        <div class="d-flex justify-content-between align-items-center">
                        <span class="pt-2">
                            <img src="https://img.icons8.com/bubbles/100/000000/male-user.png" class="align-self-start rounded-circle mr-3">
                            <span class="fw-bold">{{child.name}}</span>
                        </span>
                            <span class="time">{{moment(child.created_at).fromNow()}}</span>
                        </div>
                        <div class="media-body">
                            <p class="text">{{child.body}}</p>
                            <span @click="current_id = child.id" class="reply-btn">Reply</span>
                            <Add @clearCurrentId="clearCurrentId" :parent_id="current_id" v-if="child.id == current_id"/>
                        </div>
                        <div v-if="child.all_children.length">
                            <div v-for="sub_child in child.all_children" :key="sub_child.id" class="sub-reply">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="round pt-2">
                                        <img src="https://img.icons8.com/bubbles/100/000000/male-user.png" class="align-self-start rounded-circle mr-3">
                                        <span class="fw-bold">{{sub_child.name}}</span>
                                    </span>
                                    <span class="time">{{moment(sub_child.created_at).fromNow()}}</span>
                                </div>
                                <div class="media-body">
                                    <p class="text">{{sub_child.body}}</p>
                                    <span @click="current_id = sub_child.id" class="reply-btn">Reply</span>
                                    <Add @clearCurrentId="clearCurrentId" :parent_id="child.id" v-if="sub_child.id == current_id"/>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>




            </li>

        </ul>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'
    import Add from "./Add";
    export default {
        name: 'Comment',
        components:{
            Add
        },
        data(){
            return{
                current_id: null
            }
        },
        computed: {
            ...mapGetters(["getComments"])
        },
        methods: {
            clearCurrentId(){
                this.current_id = null;
            }
        },
        created() {
            this.$store.dispatch('getComments');
        }
    }
</script>

<style scoped>
.media .media-body{
    padding-left: 50px;
}
.reply{
    padding-left: 50px;
}
.reply .media-body{
    padding-left: 50px;
}
.sub-reply{
    padding-left: 100px;
}
.sub-reply .media-body{
    padding-left: 50px;
}
.reply-btn{
    cursor: pointer;
}
img{
    width: 50px;
}
.time{
    color: #bbb;
}

</style>
