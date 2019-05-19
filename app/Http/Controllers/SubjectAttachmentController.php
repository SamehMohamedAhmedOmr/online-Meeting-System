<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Subject_attachment;
use App\Council_meeting_subject;
use Illuminate\Http\Request;
use Validator;
use Yajra\Datatables\Datatables;
use Storage;
use Exception;

use File;

class SubjectAttachmentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store($subject_id,$meeting_number,Request $request)
    {
        $requestData['subject_id'] = (int)$subject_id;
        $requestData['meeting_number'] = $meeting_number;

        foreach($request->attachment_document as $index => $doc){
            $subject=Subject_attachment::create($requestData);
            $requestData['attachment_document']=$subject->id.'_'.$request->file('attachment_document.'.$index.'')->getClientOriginalName();
            $subject->update($requestData);
            $this->storefile($request->file('attachment_document.'.$index.''), $subject->id);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'meeting_number' => 'required|numeric|exists:council_meeting_setup,id',
            'subject_id' => 'required|numeric|exists:subject_type,id',
            'attachment_document'=>'file|mimes:abw,arc,azw,bz,bz2,css,csv,doc,docx,html,ics,js,json,odp,ods,odt,pdf,ppt,pptx,rar,swf,tar,ts,vsd,xhtml,xls,xlsx,xml,zip,7z,abc,acgi,aip,asm,asp,c,c++,cc,cpp,def,etx,for,g,h,hh,htc,idc,jav,java,list,m,mar,pl,py,rt,sdml,text,txt|max:20000'
,
        ]);
        if ($validate->fails()) {
            $errors = $validate->errors();
            return $errors;
        }
        $requestData = $request->all();
        if ($request->attachment_document) {
            $subject_attachment = Subject_attachment::findOrFail($id);
            $this->destroyfile($subject_attachment->id, $subject_attachment->attachment_document);
            $requestData['attachment_document'] = $id.'_'.$request->file('attachment_document')->getClientOriginalName();
            $subject_attachment->update($requestData);

            return redirect('subjectAttachment')->with('flash_message', 'Subject_attachment updated!');
        } else {
            $subject_attachment = Subject_attachment::findOrFail($id);
            $subject_attachment->update($requestData);

            return redirect('subjectAttachment')->with('flash_message', 'Subject_attachment updated!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id,$type)
    {
        $subject = Subject_attachment::find($id);

        if ($subject) {

            if ($subject->attachment_document) {

                $this->destroyfile($subject->id, $subject->attachment_document);
            }
            $subject->delete();
            return ($type ==1)? 1 : redirect()->back()->with('flash_message', 'Subject Attachment deleted!');
        }
        return ($type ==1)? 0 : redirect()->back()->withErrors('Faild!');
    }
    /**
     * add the specified resource to storage.
     *
     * @param  int  $file,$id
     *
     * @return state
     */
    public function storefile($file,$id)
    {
        return Storage::disk('public')->putFileAs(
            'subject_att/'.$id,
            $file,
            $id.'_'.$file->getClientOriginalName()
        );

    }
    /**
     * remove the specified resource from storage.
     *
     * @param  int  $id,$file
     *
     * @return state
     */
    public function destroyfile($id,$file)
    {
        try {
            $filePath = 'storage\subject_att\\'.$id.'\\'.$file;
            if (File::exists($filePath)) {
                return unlink($filePath);
            }
            return 1;
        } catch (Exception $ex) {
            return 0;
        }
    }

    public function downloadAttachment($subjectID,$attachmentID)
    {
        try {
            $attachment=Council_meeting_subject::find($subjectID)->Subject_attachment->find($attachmentID);
            if(!$attachment){
                return redirect()->back();
            }
            $path = 'subject_att\\'.$attachment->id.'\\'.$attachment->attachment_document;
            return response()->download(Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix().$path);
        } catch (Exception $e) {
            $attachment->delete();
            return redirect()->back();
        }
    }
}
