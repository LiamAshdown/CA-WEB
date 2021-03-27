<template>
  <b-form-group
    :id="id"
    :label="getLabel"
    :label-for="inputId"
    :description="description"
    class="font-weight-medium"
    >
      <input
      v-if="!textArea"
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
      <textarea
        v-if="textArea"
        :id="inputId"
        :type="type"
        :placeholder="placeholder"
        :aria-invalid="getErrorType === false ? 'true' : 'false'"
        class="form-control"
        :class="{ 'is-invalid': getErrorType === false }"
        :value="value"
        @input="$emit('input', $event.target.value, valueName )"
        rows="4"
        v-bind="$attrs"
      >
      </textarea>
      <b-form-invalid-feedback :state="getErrorType === false">
        {{ getErrorMessage }}
      </b-form-invalid-feedback>
  </b-form-group>
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
     * Label for Input
     */
    label: {
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
     * Enables Client side validation
     * @deprecated Currently not implemented
     */
    required: {
      type: Boolean,
      required: false,
      default: false
    },
    /**
     * v-model Value
     */
    value: {
      type: String
    },
    /**
     * Changes Input to TextArea
     */
    textArea: {
      type: Boolean,
      required: false,
      default: false
    },
    /**
     * Whether the Input is required (adds * to label)
     */
    description: {
      type: String,
      required: false,
      default: ''
    },
    /**
     * Whether the Input is required (adds * to label)
     */
    optional: {
      type: Boolean,
      required: false,
      default: true
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
    },
    getLabel () {
      return !this.optional ? `${this.label}*` : this.label
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
