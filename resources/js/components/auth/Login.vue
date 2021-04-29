<template>
    <div class="flex flex-col">
        <p class="text-gray-700 text-center text-xl font-bold mb-4">LOGIN</p>

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
            <div class="flex-shrink text-gray-700 text-sm font-medium">OR</div>
            <div class="flex-grow border border-gray-200"></div>
        </div>

        <form>
            <div class="flex flex-col my-4">
                <form-label>Email</form-label>
                <form-input type="text"></form-input>
            </div>

            <div class="flex flex-col my-4">
                <form-label>Password</form-label>
                <form-input type="password"></form-input>
            </div>

            <div class="flex flex-col my-4">
                <button-primary>Sign In</button-primary>
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
                    show: true,
                    type: 'failed',
                    message: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                },
            }
        },
    }
</script>

<style scoped>

</style>
