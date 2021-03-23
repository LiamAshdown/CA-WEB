<template>
  <div class="profile">
    <base-card>
      <b-form @submit.prevent="onSubmit">
        <base-form-group
          id="email"
          label="Email Address"
          placeholder="example@example.com"
          type="email"
          @input="updateField"
          :value="profile.email"
          :validation="errors"
        ></base-form-group>
        <b-form-row fluid>
          <b-col lg="6">
            <base-form-group
              id="first-name"
              label="First Name"
              placeholder="First Name"
              type="text"
              @input="updateField"
              :value="profile.firstName"
              :validation="errors"
            ></base-form-group>
          </b-col>
          <b-col lg="6">
            <base-form-group
              id="last-name"
              label="Last Name"
              placeholder="Last Name"
              type="text"
              v-model="profile.lastName"
              :validation="errors"
            ></base-form-group>
          </b-col>
        </b-form-row>
        <base-form-group
          id="password"
          label="Password"
          placeholder="Password"
          type="password"
          autocomplete="new-password"
          v-model="profile.password"
          :validation="errors"
        ></base-form-group>
        <base-button :loading="loading">Update</base-button>
      </b-form>
    </base-card>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import BaseButton from '@/components/ui/BaseButton.vue'

export default {
  components: { BaseButton },
  name: 'ProfilePage',
  data () {
    return {
      loading: true,
      errors: []
    }
  },
  computed: {
    ...mapGetters(['profile'])
  },
  methods: {
    async loadProfile () {
      await this.$store.dispatch('getProfile')
      this.loading = false
    },
    updateField ({ field, value }) {
      this.$store.dispatch('updateProfile', {
        [field]: value
      })
    }
  },
  created () {
    this.loadProfile()
  }
}
</script>

<style lang="scss">
.profile {
  width: 100%;
}
</style>
