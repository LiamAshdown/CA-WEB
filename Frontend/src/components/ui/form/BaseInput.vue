<template>
  <div class="w-100">
    <input
      :id="inputId"
      :type="type"
      :placeholder="placeholder"
      :aria-invalid="getErrorType === false ? 'true' : 'false'"
      class="form-control"
      :class="{ 'is-invalid': getErrorType === false }"
      :value="value"
      @input="$emit('input', $event.target.value, valueName )"
      v-bind="$attrs"
    />
    <b-form-invalid-feedback :state="getErrorType === false">
      {{ getErrorMessage }}
    </b-form-invalid-feedback>
  </div>
</template>

<script>
import { camelize } from 'humps'

/**
 * Used for creating Input/TextArea Fields
 * @displayName Base Form Group
 */
export default {
  props: {
    /**
     * Id of Input
     */
    id: {
      type: String,
      required: true
    },
    /**
     * Type of Input
     */
    type: {
      type: String,
      required: false,
      default: 'text'
    },
    /**
     * Input Placeholder
     */
    placeholder: {
      type: String,
      required: false,
      default: ''
    },
    /**
     * v-model Value
     */
    value: {
      type: [Array, String, Number, undefined]
    },
    /**
     * Validation passed from Parent Component
     */
    validation: {
      required: false,
      default () {
        return []
      }
    }
  },
  computed: {
    inputId () {
      return this.id + '-input'
    },
    getErrorType () {
      return this.validation[this.validationName] !== undefined ? false : null
    },
    getErrorMessage () {
      return this.validation[this.validationName] ? this.validation[this.validationName][0] : ''
    }
  },
  data () {
    return {
      validationName: '', // Validation
      valueName: '' // API
    }
  },
  mounted () {
    this.validationName = this.id.replace(/-/g, '_')
    this.valueName = camelize(this.id)
  }
}
</script>
