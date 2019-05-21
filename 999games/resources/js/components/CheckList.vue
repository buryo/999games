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
                    <th scope="col">Activeren/Deactiveren</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users">
                    <th scope="row">{{user.id}}</th>
                    <td>{{user.name}}</td>
                    <td>{{user.last_name}}</td>
                    <td v-if="user.status === 0">
                        <a :href="`#`" @click="activate(user.id, user)">Activeren</a>
                    </td>
                    <td v-if="user.status === 1">
                        <a :href="`#`" @click="deactivate(user.id, user)">Deactiveren</a>
                    </td>
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
        name: "check-list",
        data() {
            return {
                users: [],
                firstName: '',
                errors: new Errors()
            }
        },
        methods:{
            onFormSubmit(){
                axios.post('/attendance', {
                    firstName: this.firstName
                }).then(res => this.users = res.data)
                    .catch(error => this.errors.record(error.response.data));
            },
            activate(id, user){
                axios.post(`/attendance/activate/${id}`)
                    .then(user.status = 1)
                    .catch(error => this.errors.record(error.response.data));
            },
            deactivate(id, user){
                axios.post(`/attendance/deactivate/${id}`)
                    .then(user.status = 0)
                    .catch(error => this.errors.record(error.response.data));
            }
        },
        mounted() {
            axios.get('/attendance').
            then(res => this.users = res.data)
        }
    }
</script>

<style scoped>

</style>