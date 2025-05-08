<?php

namespace Bishopm\Hub\Filament\Resources\TenantResource\Pages;

use Bishopm\Hub\Filament\Resources\TenantResource;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ListRecords;

class ListTenants extends ListRecords
{
    protected static string $resource = TenantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('Group email')->label('Email tenants')
                ->form([
                    TextInput::make('subject'),
                    FileUpload::make('attachment')->preserveFilenames()->directory('attachments'),
                    MarkdownEditor::make('body')
                ])
                ->action(function (array $data) {
                    self::sendEmail($data);
                }),
            Actions\CreateAction::make(),
        ];
    }

    public function sendEmail($data){
        /*$tenant=Tenant::with('individuals')->where('id',$this->record->id)->first();
        $data['url'] = "https://westvillemethodist.co.za";
        $count=0;
        foreach ($tenant->individuals as $indiv){
            $data['firstname'] = $indiv['firstname'];
            if ($indiv['email']){
                //Mail::to($indiv['email'])->queue(new ChurchMail($data));
                $count++;
            }
        }
        if ($count > 1){
            Notification::make('Email sent')->title('Email sent to ' . $count . ' individuals')->send();
        } elseif ($count==1) {
            Notification::make('Email sent')->title('Email sent to 1 individual')->send();
        }*/
    }
}
