<div>
  <h3>Dear Parent,</h3>

  <p>We are writing to you to inform you of your child  perfomance <strong>Term {{$result->term}} results.</strong></p>

  <table border='1'>
    <thead>
      <tr>
        <th>Name: {{$result->studentIfo->student_first_name}}</th>
        <th>Reg: {{$result->studentIfo->student_reg}}</th>
      </tr>
      <tr>
        <th>Class: {{$result->classInfo->name}}</th>
        <th>Term: {{$result->term}}</th>
      </tr>
      <tr>
        <th>Suject</th>
        <th>Marks</th>
      </tr>
    </thead>
    <tbody>
    <!-- TODO: add a loop for all th subjects -->
      <tr>
        <td>{{$result->subject}}</td>
        <td>{{$result->marks}}</td>
      </tr>
    </tbody>
    <tfoot>
      <tr>
        <th>TOTAL</th>
        <th>{{$result->marks}}</th>
      </tr>
    </tfoot>
  </table>

  <p>Yours,</p>
  <p>
    <strong>{{$result->schoolInfo->school_name}}</strong>
  </p>
</div>
