<template>
    <div class="container">
        <form class="py-2" method="POST" action="/projects" @submit.prevent="onFormSubmit" >
            <div class="form-row">
                <div class="col-4 md-form pl-0 pr-3">
                    <input type="text" class="form-control" id="search" v-model="firstName" @keyup="onFormSubmit">
                    <label for="search">Zoek op naam</label>
                </div>
                <div class="col-3">
                    <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0"
                            type="submit">Zoeken
                    </button>
                </div>
            </div>
        </form>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">Spelernummer</th>
                <th scope="col">Naam</th>
                <th scope="col">Achternaam</th>
                <th scope="col">Toernooi punten</th>
                <th scope="col">Gewicht</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="user in users" v-on:click="goToUser(user.id)" class="curser-pointer">
                    <th scope="row">{{user.id}}</th>
                    <td>{{user.name}}</td>
                    <td>{{user.last_name}}</td>
                    <td>{{user.points}}</td>
                    <td>{{user.games}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>

    class Errors {
        constructor() {
            this.errors = {}
        }

        get(field) {
            if (this.errors[field]){
                return this.errors[field][0];
            }
        }

        record(errors) {
            this.errors = errors;
        }
    }

    export default {
        name: "leader-board",
        data() {
            return {
                users: [],
                firstName: '',
                errors: new Errors()
            }
        },
        methods:{
            onFormSubmit(){
                axios.post('/leaderboardApi', {
                    firstName: this.firstName
                }).then(res => this.users = res.data)
                    .catch(error => this.errors.record(error.response.data));
            },
            goToUser(id){
                window.location.href = "/user/" + id + "/profile";
            },
        },
        mounted() {
            axios.get('/leaderboardApi').
            then(res => this.users = res.data)
        }
    }
</script>

<style scoped>

</style>