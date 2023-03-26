<?php

namespace App\Http\Controllers;

use Response;
use App\Models\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ScoreController extends Controller
{
    public function getScoreUploadForm()
    {
        $scores = Score::orderBy('created_at','ASC')->paginate(5);
        return view('score-update', compact('scores'));
    }

    public function uploadScore(Request $request)
    {
         $this->validate($request, [
             'nama' => 'required|string|max:255',
             'nilai_quiz' => 'required|numeric|min:1|max:100',
             'nilai_tugas' => 'required|numeric|min:1|max:100',
             'nilai_absensi' => 'required|numeric|min:1|max:100',
             'nilai_praktek' => 'required|numeric|min:1|max:100',
             'nilai_uas' => 'required|numeric|min:1|max:100',
         ]);

         $score = new Score();
         $scoreQuizVal = $this->getScoreValue($request->nilai_quiz);
         $scoreTugasVal = $this->getScoreValue($request->nilai_tugas);
         $scoreAbsensiVal = $this->getScoreValue($request->nilai_absensi);
         $scorePraktekVal = $this->getScoreValue($request->nilai_praktek);
         $scoreUASVal = $this->getScoreValue($request->nilai_uas);
         $score->nama = $request->nama;
         $score->nilai_quiz = $scoreQuizVal;
         $score->nilai_tugas = $scoreTugasVal;
         $score->nilai_absensi = $scoreAbsensiVal;
         $score->nilai_praktek = $scorePraktekVal;
         $score->nilai_uas = $scoreUASVal;
         
         $score->save();

         return back()
             ->with('success','Nilai berhasil ditambahkan!');
     }

     public function getScoreValue(int $score)
     {
        if ($score <= 65) {
            $scoreValue = "D";
            return $scoreValue;
        }
        if ($score <= 75) {
            $scoreValue = "C";
            return $scoreValue;
        }
        if ($score <= 85) {
            $scoreValue = "B";
            return $scoreValue;
        }
        if ($score <= 100) {
            $scoreValue = "A";
            return $scoreValue;
        }

    }
    public function destroy($id)
    {
        Score::find($id)->delete();
        return redirect()->route('scores.get')->with('success','Nilai Berhasil Dihapus!');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,['nama'=>'required']);
        Score::find($id)->update($request->all());
        return redirect()->route('scores.get')->with('success','Nilai Berhasil Diperbarui!');
    }

    public function edit($id)
    {
        $score=Score::find($id);
        return view('score-edit',compact('score'));
    }

}
