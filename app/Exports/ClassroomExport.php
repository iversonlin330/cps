<?php

namespace App\Exports;

use App\Classroom;
use App\Exam;
use App\Http\Traits\MyTraits;
use App\UserExam;
use Maatwebsite\Excel\Concerns\FromArray;
use App\User;

class ClassroomExport implements FromArray
{
    use MyTraits;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function array(): array
    {
        $classroom_id = $this->data['classroom_id'];
        $classroom = Classroom::find($classroom_id);
        $result[] = ['班級', '座號', '姓名'];

        foreach ($classroom->students as $student) {
            $result[] = [
                $classroom->fullName(),
                $student->seat_number,
                $student->name,
            ];
        }
        return $result;
    }
}
