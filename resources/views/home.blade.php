@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-4"></div>
        <div class="col-8">
            <input type="text" name="" id="">
            <button class="btn btn-primary">Buscar</button>
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
                    <tr v-for="user in users">
                        <td>@{{user.first_name}}</td>
                        <td>@{{user.last_name}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('modal')
@endsection

@section('script')
    <script>
        new Vue({
            el: '#app',
            data: {
                users: [],
                userSelected: null,
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
                            })
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                    }
                }
            }
        });
    </script>
@endsection