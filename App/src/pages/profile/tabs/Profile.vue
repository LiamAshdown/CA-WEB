<template>
  <v-container>
    <v-form @submit.prevent="update">
      <v-text-field
        v-model="form.firstName"
        label="First Name"
        type="text"
        counter="30"
        :error-messages="errors.firstName"
        outlined
        required
      ></v-text-field>

      <v-text-field
        v-model="form.lastName"
        label="Last Name"
        type="text"
        counter="30"
        :error-messages="errors.lastName"
        outlined
        required
      ></v-text-field>

      <v-text-field
        v-model="form.email"
        label="Email"
        type="email"
        :error-messages="errors.email"
        outlined
        required
      ></v-text-field>

      <v-text-field
        v-model="form.password"
        label="Password"
        :type="showPassword ? 'text' : 'password'"
        :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
        @click:append="showPassword = !showPassword"
        :error-messages="errors.password"
        outlined
        required
      ></v-text-field>

      <v-btn
        depressed
        color="primary"
        type="submit"
        :loading="loading"
        block
      >Update</v-btn>
    </v-form>
  </v-container>
</template>

<script>
export default {
  name: 'ProfileTab',
  data () {
    return {
      showPassword: false,
      loading: false,
      form: {
        firstName: '',
        lastName: '',
        email: '',
        password: ''
      },
      errors: {}
    }
  },
  methods: {
    async profile () {
      this.form = await this.$api.profile.show()
    },
    async update () {
      this.loading = true
      this.errors = {}

      try {
        await this.$api.profile.update(this.form)
      } catch (e) {
        this.errors = e.response.data.errors
      } finally {
        this.loading = false
      }
    }
  },
  mounted () {
    this.profile()
  }
}
</script>
