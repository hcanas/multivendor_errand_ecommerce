<template>
    <div class="flex flex-col">
        <p class="text-gray-700 text-center text-xl font-bold mb-4">RESET PASSWORD</p>

        <component v-show="alert.show" :is="`alert-${alert.type}`">{{alert.message}}</component>

        <form>
            <div class="flex flex-col my-4">
                <form-label>Email</form-label>
                <form-input type="email"></form-input>
                <form-error>Mauris scelerisque eros lorem, et molestie mi vestibulum a. Etiam.</form-error>
            </div>

            <div class="flex flex-col my-4">
                <form-label>Code</form-label>
                <form-input type="text"></form-input>
                <form-helper>
                    <span>Don't have a code? </span>
                    <link-primary v-if="code_request.status === 'standby'" :to="``" @click="pop_up.show = true">Request now.</link-primary>
                    <span v-else-if="code_request.status === 'sending'" class="animate-pulse">Sending...</span>
                    <span v-else-if="code_request.status === 'sent'">Request again in {{code_request.timer_left}}s.</span>
                </form-helper>
                <form-error>Mauris scelerisque eros lorem, et molestie mi vestibulum a. Etiam.</form-error>
            </div>

            <div class="flex flex-col my-4">
                <form-label>New Password</form-label>
                <form-input type="password"></form-input>
                <form-error>Mauris scelerisque eros lorem, et molestie mi vestibulum a. Etiam.</form-error>
            </div>

            <div class="flex flex-col my-4">
                <form-label>Confirm New Password</form-label>
                <form-input type="password"></form-input>
                <form-error>Mauris scelerisque eros lorem, et molestie mi vestibulum a. Etiam.</form-error>
            </div>

            <div class="flex flex-col my-4">
                <button-primary>Save Password</button-primary>
            </div>
        </form>

        <div class="flex justify-center my-4">
            <link-primary :to="``" @click="$emit('login')">Back to Login</link-primary>
        </div>
    </div>

    <pop-up v-show="pop_up.show" @close="pop_up.show = false">
        <div class="w-56">
            <code-sent></code-sent>
        </div>
    </pop-up>
</template>

<script>
    import FormLabel from "../form/Label";
    import FormInput from "../form/Input";
    import FormHelper from "../form/Helper";
    import FormError from "../form/Error";
    import ButtonPrimary from "../buttons/Primary";
    import LinkPrimary from "../links/Primary";
    import PopUp from "../overlays/PopUp";
    import CodeSent from "../messages/CodeSent";
    import AlertSuccess from "../alerts/Success";
    import AlertFailed from "../alerts/Failed";

    export default {
        name: "Recovery",
        components: {
            FormLabel,
            FormInput,
            FormHelper,
            FormError,
            ButtonPrimary,
            LinkPrimary,
            PopUp,
            CodeSent,
            AlertSuccess,
            AlertFailed,
        },
        data() {
            return {
                code_request: {
                    status: 'standby',
                    timer: 30,
                    timer_left: 30,
                },
                pop_up: {
                    show: false,
                },
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
