<?php

namespace App\Exports;

use App\Exam;
use App\Http\Traits\MyTraits;
use App\UserExam;
use Maatwebsite\Excel\Concerns\FromArray;
use App\User;

class ScoreExport implements FromArray
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
        //
        $exam_id = $this->data['exam_id'];
        $classroom_id = $this->data['classroom_id'];

        //$exam = Exam::find($exam_id)->classroom->where('id',$classroom_id);
        $user_ids = User::student()->where('classroom_id', $classroom_id)->get()->pluck('id')->toArray();

        $user_exams = UserExam::whereIn('user_id', $user_ids)->where('exam_id', $exam_id)->get();

        //$result[] = ['ID', '教師姓名', '所屬縣市', '服務學校', '性別', '任教科目', '任教年級', '任教班級', '電子郵件', '密碼'];
        $result[] = ['學生帳號', '姓名', '性別', '能力指標A1', '能力指標A2', '能力指標A3', '能力指標B1', '能力指標B2', '能力指標B3', '能力指標C1', '能力指標C2', '能力指標C3', '能力指標D1', '能力指標D2', '能力指標D3', '個人總成績'];

        $exam = Exam::find($exam_id);
        $count = $exam->score_count();

        foreach ($user_exams as $user_exam) {
            if (!$user_exam->user) {
                continue;
            }
            $score = $this->calScore($user_exam->score, $count);
            $result[] = [
                $user_exam->user->account,
                $user_exam->user->name,
                config('map.gender')[$user_exam->user->gender],
                $score[1],
                $score[2],
                $score[3],
                $score[4],
                $score[5],
                $score[6],
                $score[7],
                $score[8],
                $score[9],
                $score[10],
                $score[11],
                $score[12],
                array_sum($score)
            ];
        }
        /*
                foreach($users as $user){
                    if(!$user->user_info)
                        continue;
                    //dd($user->id,$user->user_info);
                    $result[] = [
                        $user->user_info->t_id,
                        $user->name,
                        $user->user_info->city_id,
                        $user->user_info->school_id,
                        Config('map . gender')[$user->gender],
                        implode(',',$user->user_info->subject),
                        $user->user_info->grade,
                        $user->user_info->classroom,
                        $user->account,
                        $user->password,
                    ];
                }
        */
        return $result;
    }
}
