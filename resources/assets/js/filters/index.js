import moment from 'moment'

export default function age(value) {
  const age = moment().diff(value, 'years')
  return age
}