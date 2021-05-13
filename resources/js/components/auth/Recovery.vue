<template>
    <div class="flex flex-col">
        <p class="text-center text-xl font-bold mb-4">RESET PASSWORD</p>

        <component v-show="alert.show" :is="`alert-${alert.type}`">{{alert.message}}</component>

        <form>
            <div class="flex flex-col my-4">
                <form-label>Email</form-label>
                <form-input type="email" :value="form_data.email" @input="form_data.email = $event.target.value"></form-input>
                <form-error>{{ form_errors.hasOwnProperty('email') ? form_errors.email[0] : '' }}</form-error>
            </div>

            <div class="flex flex-col my-4">
                <form-label>Code</form-label>
                <form-input type="text" maxlength="8" :value="form_data.code" @input="form_data.code = $event.target.value"></form-input>
                <form-helper>
                    <span>Don't have a code? </span>
                    <link-primary v-if="code_request.status === 'standby'" :to="``" @click="sendCode()">Request now.</link-primary>
                    <span v-else-if="code_request.status === 'sending'" class="animate-pulse">Sending...</span>
                    <span v-else-if="code_request.status === 'sent'">Request again in {{code_request.timer_left}}s.</span>
                </form-helper>
                <form-error>{{ form_errors.hasOwnProperty('code') ? form_errors.code[0] : '' }}</form-error>
            </div>

            <div class="flex flex-col my-4">
                <form-label>New Password</form-label>
                <form-input type="password" :value="form_data.password" @input="form_data.password = $event.target.value"></form-input>
                <form-error>{{ form_errors.hasOwnProperty('password') ? form_errors.password[0] : '' }}</form-error>
            </div>

            <div class="flex flex-col my-4">
                <form-label>Confirm New Password</form-label>
                <form-input type="password" :value="form_data.confirm_password" @input="form_data.confirm_password = $event.target.value"></form-input>
                <form-error>{{ form_errors.hasOwnProperty('confirm_password') ? form_errors.confirm_password[0] : '' }}</form-error>
            </div>

            <div class="flex flex-col my-4">
                <button-primary @click="savePassword()" :disabled="save_password.status !== 'standby'">
                    <span v-if="save_password.status === 'standby'">Save Password</span>
                    <span v-else-if="save_password.status === 'processing'" class="animate-pulse flex justify-center items-center space-x-1">
                        <span class="animate-spin fas fa-circle-notch"></span>
                        <span>Saving Password</span>
                    </span>
                </button-primary>
            </div>
        </form>

        <div class="flex justify-center my-4">
            <link-primary :to="``" @click="$emit('login')">Back to Login</link-primary>
        </div>
    </div>
</template>

<script>
    import FormLabel from "../form/Label";
    import FormInput from "../form/Input";
    import FormHelper from "../form/Helper";
    import FormError from "../form/Error";
    import ButtonPrimary from "../buttons/Primary";
    import LinkPrimary from "../links/Primary";
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
                alert: {
                    show: false,
                    type: '',
                    message: '',
                },
                save_password: {
                    status: 'standby',
                },
                timers: [],
                form_data: {
                    email: '',
                    code: '',
                    password: '',
                    confirm_password: '',
                },
                form_errors: {},
            }
        },
        methods: {
            sendCode() {
                this.clearTimers();
                this.clearErrors();
                this.code_request.status = 'sending';

                axios.post('/api/verification_code/password', {email: this.form_data.email})
                    .then(response => {
                        this.alert.show = true;
                        this.alert.type = 'success';
                        this.alert.message = response.data;
                        this.code_request.status = 'sent';

                        this.timers.push(setInterval(function () {
                            this.code_request.timer_left -= this.code_request.timer_left > 0 ? 1 : 0;
                        }.bind(this), 1000));

                        this.timers.push(setTimeout(function () {
                            this.code_request.status = 'standby';
                            this.code_request.timer_left = this.code_request.timer;
                        }.bind(this), this.code_request.timer * 1000));
                    })
                    .catch(error => {
                        this.code_request.status = 'standby';
                        const errors = error.response.data;

                        if (typeof errors === 'object') {
                            this.form_errors = errors;
                        } else {
                            this.alert.show = true;
                            this.alert.type = 'failed';
                            this.alert.message = errors;
                        }
                    });
            },
            savePassword() {
                this.clearTimers();
                this.clearErrors();
                this.save_password.status = 'processing';

                axios.post('/api/password_reset', this.form_data)
                    .then(response => {
                        this.alert.show = true;
                        this.alert.type = 'success';
                        this.alert.message = 'Your password has been changed. You may now login.';
                    })
                    .catch(error => {
                        const errors = error.response.data;

                        if (typeof errors === 'object') {
                            this.form_errors = errors;
                        } else {
                            this.alert.show = true;
                            this.alert.type = 'failed';
                            this.alert.message = errors;
                        }
                    })
                    .finally(() => {
                        this.save_password.status = 'standby';
                        this.clearPasswords();
                    });
            },
            clearTimers() {
                for (let i = 0; i < this.timers.length; i++) {
                    clearInterval(this.timers[i]);
                    clearTimeout(this.timers[i]);
                }

                this.code_request.status = 'standby';
                this.code_request.timer_left = this.code_request.timer;
            },
            clearErrors() {
                this.alert.show = false;
                this.alert.type = '';
                this.alert.message = '';
                this.form_errors = {};
            },
            clearPasswords() {
                this.form_data.password = '';
                this.form_data.confirm_password = '';
            },
        },
    }
</script>

<style scoped>

</style>
