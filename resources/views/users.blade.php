@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-4"></div>
        <div class="col-8">
            <input type="number" v-bind="search" id="search" min="0" max="15">
            <button class="btn btn-primary" onclick="app.evaluateSearch($('#search').val())">Buscar</button>
        </div>
    </div>
    <div class="row">
        <div class="col-12" id="app">
            <table class="table table-hover table-sprite">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <template v-if="Object.keys(users).length === 0">
                        <p class="text-danger">No existen usuarios registrados</p>
                    </template>
                    <template v-else>
                        <tr v-for="user in showUsers">
                            <td v-on:click="openModal(user)" data-toggle="modal" data-target="#modalUser">@{{user.first_name}}</td>
                            <td v-on:click="openModal(user)" data-toggle="modal" data-target="#modalUser">@{{user.last_name}}</td>
                            <td v-on:click="openModal(user)" data-toggle="modal" data-target="#modalUser">@{{user.email}}</td>
                            <td>
                                <button class="btn btn-danger" v-on:click="deleteUser(user.id)">Eliminar</button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-10"></div>
        <div class="col-2">
            <a href="{{url('/')}}" class="btn btn-primary">Página de inicio</a>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var app = new Vue({
            el: '#app',
            data: {
                users: [],
                showUsers: [],
                userSelected: [],
                search: '',
                message: '',
            },
            created: function () {
                this.getUsers();
            },
            methods: {
                getUsers: function () {
                    axios
                    .get('users')
                    .then((response) => {
                        this.users = response.data;
                        this.showUsers = this.users;
                    })
                    .catch(function(error) {
                        this.message = "Lo sentimos, intente más tarde.";
                        $("#message").text(this.message);
                        $("#modalError").modal();
                    });
                },
                openModal: function(user) {
                    this.userSelected = user;
                    $('img').attr('src', user.avatar);
                    $("#first_name").text("Nombre: " + user.first_name);
                    $("#last_name").text("Apellido: " + user.last_name);
                    $("#email").text("Email: " + user.email);
                    // console.log(this.userSelected.avatar);
                },
                evaluateSearch: function(number) {
                    if (number <= 0 || number > 15) {
                        // console.log("Error! Número fuera del rango");
                        this.message = "Lo sentimos, intente más tarde.";
                        $("#message").text(this.message);
                        $("#modalError").modal();
                        this.showUsers = this.users;
                        return;
                    }
                    if (Number.isNaN(number) || number == '') {
                        // console.log("Error! No es un número");
                        this.message = "Usuario no encontrado";
                        $("#message").text(this.message);
                        $("#modalError").modal();
                        this.showUsers = this.users;
                        return;
                    }
                    this.showUsers = [];
                    var flag = false;
                    this.users.map(element => {
                        if(element.id == number) {
                            flag = true;
                            this.showUsers.push(element);
                        }
                    });
                    if (!flag) {
                        this.message = "Usuario no encontrado";
                        $("#message").text(this.message);
                        $("#modalError").modal();
                        this.showUsers = this.users;
                    }
                    // console.log(number);
                },
                registerUser: function() {
                    axios.post("{{url('users')}}",{
                        data: this.userSelected,
                    }).then(response => {
                        // console.log(response.data);
                        this.message = "Usuario agregado con éxito";
                        $("#message").text(this.message);
                        $("#modalUser").modal('toggle');
                        $("#modalSuccess").modal();
                    }).catch(error => {
                        // console.log(error.response);
                        this.message = "Lo sentimos, intente más tarde.";
                        $("#message").text(this.message);
                        $("#modalError").modal();
                    });
                    // console.log(this.userSelected);
                },
                deleteUser: function(id) {
                    axios.delete('users/' + id, {
                        data: {id},
                    }).then(response => {
                        // console.log(response);
                        this.getUsers();
                    }).catch(error => {
                        // console.log(error.response);
                        this.message = "Lo sentimos, intente más tarde.";
                        $("#message").text(this.message);
                        $("#modalError").modal();
                    });
                }
            }
        });
   </script>
@endsection