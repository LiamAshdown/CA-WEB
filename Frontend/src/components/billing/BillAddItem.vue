<template>
  <div class="item__add">
    <base-button class="item__add__existing"><b-icon icon="plus"></b-icon>Add Existing Item</base-button>
    <b-form @submit.prevent="onSubmit">
      <b-form-row fluid>
        <b-col cols="12">
          <base-form-group
            id="name"
            label="Name"
            type="text"
            :value="item.name"
            @input="updateField"
            :validation="errors"
          ></base-form-group>
        </b-col>
      </b-form-row>
      <b-form-row fluid>
        <b-col cols="12">
          <base-form-group
            id="quantity"
            label="Quantity"
            type="number"
            :value="item.quantity"
            @input="updateField"
            :validation="errors"
          ></base-form-group>
        </b-col>
      </b-form-row>
      <b-form-row fluid>
        <b-col cols="12">
          <base-form-group
            id="unit"
            label="Unit"
            type="text"
            :value="item.unit"
            @input="updateField"
            :validation="errors"
          ></base-form-group>
        </b-col>
      </b-form-row>
      <b-form-row fluid>
        <b-col cols="12">
          <base-form-group
            id="net"
            label="Price (net)"
            type="text"
            :value="item.net"
            @input="updateField"
            :validation="errors"
          ></base-form-group>
        </b-col>
      </b-form-row>
      <b-form-row fluid>
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
      </b-form-row>
      <b-form-row fluid>
        <b-col cols="12">
          <base-form-group
            id="amount"
            label="Amount (net)"
            :value="calculateGross"
            disabled
          ></base-form-group>
        </b-col>
      </b-form-row>
      <b-form-row fluid>
        <b-col cols="12">
          <base-form-group
            id="description"
            label="Description"
            :textArea="true"
            :value="item.description"
            @input="updateField"
            :validation="errors"
          ></base-form-group>
        </b-col>
      </b-form-row>
    <base-button :loading="loading">Add</base-button>
    </b-form>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'BillAddItem',
  data () {
    return {
      errors: [],
      loading: false,
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
      return ((this.item.net * (this.item.vat / 100)) * this.item.quantity).toLocaleString()
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
        // Create the item
        await this.$store.dispatch('items/create')

        // Add newly created item to store
        this.$store.dispatch('estimates/addItem')

        this.$emit('updateState', 'addNew', false)
      } catch (err) {
        this.errors = err.response.data.errors
      }

      this.loading = false
    }
  }
}
</script>

<style lang="scss" scoped>
.item {
  &__add {
    &__existing {
      position: absolute;
      top: 0;
      right: 0px;
      margin: 20px;
    }
  }
}
</style>
