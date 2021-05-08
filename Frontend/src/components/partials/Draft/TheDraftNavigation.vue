<template>
  <b-navbar class="topbar shadow-sm" sticky>
      <div class="d-flex justify-content-between w-100">
        <base-button :to="{ name: 'CreateBill' }"><b-icon icon="arrow-left"></b-icon> Back</base-button>
        <base-button @click="saveDraft" :loading="loading"><font-awesome-icon icon="save"/> Save Draft</base-button>
      </div>
  </b-navbar>
</template>

<script>
export default {
  name: 'TheDraftNavigation',
  data () {
    return {
      loading: false
    }
  },
  methods: {
    saveDraft () {
      this.loading = true
      this.$store.dispatch('bills/saveDraft', {
        save: new Date().getUTCMilliseconds() // Just to trigger the watch
      }).then(() => {
        this.$router.push({ name: 'CreateBill' })
      })
    }
  }
}
</script>

<style lang="scss" scoped>
.topbar {
  height: 60px;
  background-color: #fff;
}
</style>
