<template>
    <div class="flex flex-col">
        <p class="text-center text-xl font-bold mb-4">LOGIN</p>

        <component v-show="alert.show" :is="`alert-${alert.type}`">{{alert.message}}</component>

        <div class="flex flex-col my-4">
            <button-light>
                <div class="flex items-center space-x-2">
                    <img src="/images/g-logo.png" alt="google logo" class="w-5 h-5">
                    <span>Continue with Google</span>
                </div>
            </button-light>
        </div>

        <div class="flex items-center space-x-2">
            <div class="flex-grow border border-gray-200"></div>
            <div class="flex-shrink text-sm font-medium">OR</div>
            <div class="flex-grow border border-gray-200"></div>
        </div>

        <form>
            <div class="flex flex-col my-4">
                <form-label>Email</form-label>
                <form-input type="text" :value="form_data.email" @input="form_data.email = $event.target.value"></form-input>
            </div>

            <div class="flex flex-col my-4">
                <form-label>Password</form-label>
                <form-input type="password" :value="form_data.password" @input="form_data.password = $event.target.value"></form-input>
            </div>

            <div class="flex flex-col my-4">
                <button-primary type="submit" @click.prevent="signIn()">
                    <span v-if="sign_in.status === 'standby'">Sign In</span>
                    <span v-else-if="sign_in.status === 'processing'" class="flex justify-center items-center space-x-1">
                        <i class="animate-spin fas fa-circle-notch"></i>
                        <span>Logging In</span>
                    </span>
                </button-primary>
            </div>
        </form>

        <div class="flex justify-between my-4">
            <link-primary :to="``" @click="$emit('createAccount')">Create Account</link-primary>
            <link-primary :to="``" @click="$emit('forgotPassword')">Forgot Password</link-primary>
        </div>
    </div>
</template>

<script>
    import FormLabel from "../form/Label";
    import FormInput from "../form/Input";
    import ButtonPrimary from "../buttons/Primary";
    import ButtonLight from "../buttons/Light";
    import LinkPrimary from "../links/Primary";
    import AlertFailed from "../alerts/Failed";

    export default {
        name: "Login",
        components: {
            FormLabel,
            FormInput,
            ButtonPrimary,
            ButtonLight,
            LinkPrimary,
            AlertFailed,
        },
        data() {
            return {
                alert: {
                    show: false,
                    type: '',
                    message: '',
                },
                sign_in: {
                    status: 'standby',
                },
                form_data: {
                    email: '',
                    password: '',
                },
            }
        },
        methods: {
            signIn() {
                this.alert.show = false;
                this.sign_in.status = 'processing';

                axios.post('/api/auth/tokens', this.form_data)
                    .then(response => {
                        this.$store.dispatch('auth/setToken', response.data);
                        this.$emit('loggedIn');
                    })
                    .catch(error => {
                        this.alert.show = true;
                        this.alert.type = 'failed';
                        this.alert.message = 'Incorrect username or password.';
                    })
                    .finally(() => {
                        this.sign_in.status = 'standby';
                    });
            },
        },
    }
</script>

<style scoped>

</style>
