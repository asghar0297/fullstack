<template>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                <li class="nav-item">
                    <router-link class="nav-link active" aria-current="page" :to="{name:'home'}">Home</router-link>
                </li>
                <li class="nav-item">
                    <router-link  class="nav-link" :to="{name:'login'}" v-if="$store.getters.getToken == 0">Login</router-link>
                </li>
                <li class="nav-item">
                    <router-link  class="nav-link" :to="{name:'register'}" v-if="$store.getters.getToken == 0">Register</router-link>
                </li>
                <li class="nav-item">
                    <router-link  class="nav-link" :to="{name:'dashboard'}" v-if="$store.getters.getToken != 0">Dashboard</router-link>
                </li>
                </ul>
            </div>
            </div>
        </nav>

        <router-view></router-view>
</template>




