<template>
    <div>
        <div class="flex justify-between p-8 w-96 mx-auto">
            <router-link v-if="!token" :to="{ name: 'user.login' }">
                Войти
            </router-link>
            <router-link v-if="token" :to="{ name: 'user.index' }">
                Пользователи
            </router-link>
            <router-link v-if="token" :to="{ name: 'user.feed' }">
                Новости
            </router-link>
            <router-link v-if="token" :to="{ name: 'user.personal' }">
                Мои
            </router-link>
            <router-link v-if="!token" :to="{ name: 'user.registration' }">
                Регистрация
            </router-link>
            <a v-if="token" @click.prevent="logout" href="#">Logout</a>
        </div>

        <router-view></router-view>
    </div>
</template>
<script>
export default {
    name: "App",
    data() {
        return {
            token: null,
        };
    },

    mounted() {
        this.getToken();
    },

    watch: {
        $route(to, from) {
            this.getToken();
        },
    },

    methods: {
        getToken() {
            this.token = localStorage.getItem("x_xsrf_token");
        },

        logout() {
            axios.post("/logout").then((res) => {
                localStorage.removeItem("x_xsrf_token");
                this.$router.push({ name: "user.login" });
            });
        },
    },
};
</script>
<style lang=""></style>
