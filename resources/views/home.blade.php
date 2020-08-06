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
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in showUsers">
                        <td v-on:click="openModal(user)" data-toggle="modal" data-target="#modalUser">@{{user.first_name}}</td>
                        <td v-on:click="openModal(user)" data-toggle="modal" data-target="#modalUser">@{{user.last_name}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('modal')
    <div class="modal fade" id="modalUser" tabindex="-1" role="dialog" aria-labelledby="modalUserLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalUserLabel">Registrar usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4">
                            <img src="">
                        </div>
                        <div class="col-7">
                            <label id="first_name"></label><br />
                            <label id="last_name"></label><br />
                            <label id="email"></label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="app.registerUser()">Registrar</button>
                </div>
            </div>
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
            },
            created: function () {
                this.getUsers();
            },
            methods: {
                getUsers: function () {
                    for (let index = 1; index < 3; index++) {
                        axios
                        .get('https://reqres.in/api/users?page=' + index)
                        .then((response) => {
                            response.data.data.map(element => {
                                this.users.push(element);
                            });
                            this.showUsers = this.users;
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                    }
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
                        console.log("Error! Número fuera del rango");
                        this.showUsers = this.users;
                        return;
                    }
                    if (Number.isNaN(number) || number == '') {
                        console.log("Error! No es un número");
                        this.showUsers = this.users;
                        return;
                    }
                    this.showUsers = [];
                    this.users.map(element => {
                        if(element.id == number) {
                            this.showUsers.push(element);
                        }
                    });
                    console.log(number);
                },
                registerUser: function() {
                    console.log(this.userSelected);
                }
            }
        });
   </script>
@endsection