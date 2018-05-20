const getters = {
  sidebar: state => state.app.sidebar,
  token: state => state.user.token,
  avatar: state => state.user.avatar,
  name: state => state.user.username,
  roles: state => state.user.roles,
  school: state => state.user.school,
  classes: state => state.user.classes,
  teachers: state => state.user.teachers,
  students: state => state.user.students,
  users: state => state.user.users
}
export default getters
