import ConfirmationPage from "@/components/ui/auth/confirmation-page";

export default function ConfirmPage({ params }: { params: { token: string } }) {
  return (
    <>
      <ConfirmationPage token={params.token}></ConfirmationPage>
    </>
  );
}
