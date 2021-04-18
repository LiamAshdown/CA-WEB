<template>
  <b-container fluid>
    <h1 class="page-title">Add Item</h1>
    <b-row>
      <b-col cols="12" lg="6">
        <base-card>
          <b-form @submit.prevent="onSubmit">
            <b-form-row fluid>
              <b-col lg="6" cols="12">
                <base-form-group
                  id="name"
                  label="Name"
                  type="text"
                  :value="item.name"
                  @input="updateField"
                  :validation="errors"
                ></base-form-group>
              </b-col>
              <b-col lg="6" cols="12">
                <base-form-group
                  id="net"
                  label="Net Price (without VAT)"
                  type="number"
                  :value="item.net"
                  @input="updateField"
                  :validation="errors"
                ></base-form-group>
              </b-col>
            </b-form-row>
            <b-form-row fluid>
              <b-col lg="6" cols="12">
                <base-form-group
                  id="description"
                  label="Description"
                  :textArea="true"
                  rows="5"
                  :value="item.description"
                  @input="updateField"
                  :validation="errors"
                ></base-form-group>
              </b-col>
              <b-col lg="6" cols="12">
                <b-form-row>
                  <b-col cols="12">
                    <base-form-group
                      id="vat"
                      label="VAT"
                      :select="true"
                      :options="vatOptions"
                      :value="item.vat"
                      @input="updateField"
                      :validation="errors"
                    ></base-form-group>
                  </b-col>
                  <b-col cols="12">
                    <base-form-group
                      id="gross"
                      label="Gross Price (with VAT)"
                      @input="updateField"
                      :value="calculateGross"
                      disabled
                    ></base-form-group>
                  </b-col>
                </b-form-row>
              </b-col>
            </b-form-row>
            <base-button :loading="loading">Create</base-button>
          </b-form>
        </base-card>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'AddItem',
  data () {
    return {
      loading: false,
      errors: [],
      vatOptions: [
        { value: '20', text: '20%' },
        { value: '5', text: '5%' },
        { value: '0', text: '0%' }
      ]
    }
  },
  computed: {
    ...mapGetters({
      item: 'items/item'
    }),
    calculateGross () {
      return (this.item.net * (this.item.vat / 100)).toLocaleString()
    }
  },
  methods: {
    updateField (value, field) {
      this.$store.dispatch('items/set', {
        [field]: value
      })
    },
    async onSubmit () {
      this.loading = true
      this.errors = []

      try {
        await this.$store.dispatch('items/create')
        this.$router.push({ name: 'Users' })
      } catch (err) {
        this.errors = err.response.data.errors
      }

      this.loading = false
    }
  }
}
</script>
